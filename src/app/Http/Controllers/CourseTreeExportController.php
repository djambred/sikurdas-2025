<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use Barryvdh\DomPDF\Facade\Pdf;

class CourseTreeExportController extends Controller
{
    /**
     * Export PDF - semua course atau per major (opsional).
     *
     * URL Contoh:
     * - /course-tree/pdf                → semua major
     * - /course-tree/pdf?major=3        → berdasarkan ID major
     * - /course-tree/pdf?major=Informatika → berdasarkan nama major
     */
    public function exportPdf(Request $request)
    {
        $majorParam = $request->query('major');

        if ($majorParam !== null && $majorParam !== '') {
            // Bisa ID atau nama
            if (is_numeric($majorParam)) {
                $major = Major::find((int)$majorParam);
            } else {
                $major = Major::where('name', $majorParam)->first();
            }

            if (!$major) {
                abort(404, 'Program Studi (major) tidak ditemukan.');
            }

            // Ambil course per major
            $courses = Course::where('major_id', $major->id)
                ->with('prerequisites')
                ->orderBy('semester', 'asc')
                ->get();

            $title = 'Struktur Mata Kuliah — ' . $major->name;
        } else {
            // Semua major
            $courses = Course::with('major', 'prerequisites')
                ->orderBy('major_id')
                ->orderBy('semester', 'asc')
                ->get();

            $title = 'Struktur Mata Kuliah — Semua Program Studi';
            $major = null;
        }
        Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans', // font yang umumnya mendukung Unicode
        ]);
        // === Render ke PDF ===
        $pdf = Pdf::loadView('filament.custom.course-tree-blade-only', [
            'title'   => $title,
            'courses' => $courses,
            'forPdf'  => true,
            'major'   => $major,
        ]);

        // 📄 Atur orientasi ke landscape
        $pdf->setPaper('a4', 'landscape');

        // Nama file dinamis
        $filename = 'mapping-mata-kuliah' . ($major ? '-' . \Str::slug($major->name) : '-all') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Preview HTML (opsional).
     * Bisa juga gunakan ?major=... untuk filter.
     */
    public function preview(Request $request)
    {
        $majorParam = $request->query('major');

        if ($majorParam !== null && $majorParam !== '') {
            if (is_numeric($majorParam)) {
                $major = Major::find((int)$majorParam);
            } else {
                $major = Major::where('name', $majorParam)->first();
            }

            if (!$major) {
                abort(404, 'Program Studi (major) tidak ditemukan.');
            }

            $courses = Course::where('major_id', $major->id)
                ->with('prerequisites')
                ->orderBy('semester', 'asc')
                ->get();

            $title = 'Preview: Struktur Mata Kuliah — ' . $major->name;
        } else {
            $courses = Course::with('major', 'prerequisites')
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
