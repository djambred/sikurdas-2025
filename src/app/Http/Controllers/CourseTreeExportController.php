<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str; // Tambahkan ini

class CourseTreeExportController extends Controller
{
    /**
     * Export PDF - semua course atau per major (opsional).
     */
    public function exportPdf(Request $request)
    {
        $majorParam = $request->query('major');
        $major = null;
        $title = 'Struktur Mata Kuliah';

        // Relasi dasar yang dibutuhkan untuk Course
        $relations = ['prerequisites', 'pl', 'cpl', 'ik', 'cpmk'];

        if ($majorParam !== null && $majorParam !== '') {
            // Mode filter per Major
            if (is_numeric($majorParam)) {
                $major = Major::find((int)$majorParam);
            } else {
                // Mencari berdasarkan slug atau nama parsial
                $major = Major::where('name', 'LIKE', '%' . $majorParam . '%')->first();
            }

            if (!$major) {
                abort(404, 'Program Studi (major) tidak ditemukan.');
            }

            $courses = Course::where('major_id', $major->id)
                // Di mode filter, relasi major tidak perlu di-load karena sudah pasti
                ->with($relations)
                ->orderBy('semester', 'asc')
                ->get();

            $title .= ' — ' . $major->name;
        } else {
            // Mode Semua Program Studi
            // WAJIB load relasi 'major' agar grouping di Blade bekerja
            $courses = Course::with(array_merge($relations, ['major']))
                ->orderBy('major_id')
                ->orderBy('semester', 'asc')
                ->get();

            // Tambahkan detail jumlah Major yang unik (untuk menarik)
            $majorCount = $courses->pluck('major.name')->filter()->unique()->count();

            $title .= ' — Semua Program Studi (' . $majorCount . ' Major)';
            $major = null;
        }

        // --- PDF OPTIONS ---
        Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            // Pastikan font mendukung karakter non-latin
            'defaultFont' => 'DejaVu Sans',
            'chroot' => public_path(),
        ]);

        $pdf = Pdf::loadView('filament.custom.course-tree-blade-only', [
            'title'   => $title,
            'courses' => $courses,
            'forPdf'  => true,
            'major'   => $major,
        ]);

        $pdf->setPaper('a4', 'landscape');

        // --- NAMA FILE YANG LEBIH BAIK ---
        // Gunakan Str::slug dari Illuminate\Support\Str
        $filename = 'struktur-mata-kuliah' . ($major ? '-' . Str::slug($major->name) : '-all') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Preview HTML (opsional).
     */
    public function preview(Request $request)
    {
        $majorParam = $request->query('major');
        $major = null;

        $relations = ['prerequisites', 'pl', 'cpl', 'ik', 'cpmk'];

        if ($majorParam !== null && $majorParam !== '') {
            if (is_numeric($majorParam)) {
                $major = Major::find((int)$majorParam);
            } else {
                $major = Major::where('name', 'LIKE', '%' . $majorParam . '%')->first();
            }

            if (!$major) {
                abort(404, 'Program Studi (major) tidak ditemukan.');
            }

            $courses = Course::where('major_id', $major->id)
                ->with($relations)
                ->orderBy('semester', 'asc')
                ->get();

            $title = 'Preview: Struktur Mata Kuliah — ' . $major->name;
        } else {
            $courses = Course::with(array_merge($relations, ['major']))
                ->orderBy('major_id')
                ->orderBy('semester', 'asc')
                ->get();

            $title = 'Preview: Struktur Mata Kuliah — Semua Program Studi';
            $major = null;
        }

        return view('filament.custom.course-tree-blade-only', [
            'title'   => $title,
            'courses' => $courses,
            'forPdf'  => false,
            'major'   => $major,
        ]);
    }
}
