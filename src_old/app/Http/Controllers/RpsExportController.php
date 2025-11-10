<?php

namespace App\Http\Controllers;

use App\Models\Rps;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RpsExportController extends Controller
{
    public function preview(Rps $rps)
    {
        return view('rps.templates.standard', ['rps' => $rps]);
    }

    public function export(Rps $rps)
    {
        Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ]);

        $pdf = Pdf::loadView('rps.templates.standard', ['rps' => $rps])
            ->setPaper('a4', 'landscape');

        $filename = 'RPS-' . \Str::slug($rps->major->name ?? 'major') . '-' . \Str::slug($rps->course->nama ?? $rps->nama) . '-smt' . ($rps->semester ?? '') . '.pdf';

        return $pdf->download($filename);
    }
}
