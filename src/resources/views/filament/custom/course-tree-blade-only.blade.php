{{-- resources/views/filament/custom/course-tree-blade-only.blade.php --}}
@props(['title' => 'Struktur Mata Kuliah', 'courses'])

@php
    // Normalisasi input: pastikan kita punya array of arrays
    $coursesArr = $courses instanceof \Illuminate\Support\Collection ? $courses->values()->all() : ($courses ?: []);
    $normalized = array_map(function($c) {
        if (is_object($c)) {
            $arr = method_exists($c, 'toArray') ? $c->toArray() : (array) $c;
        } else {
            $arr = (array) $c;
        }

        // Normalisasi prerequisites => array of ids
        if (isset($arr['prerequisites'])) {
            if (is_object($arr['prerequisites']) && method_exists($arr['prerequisites'], 'pluck')) {
                $arr['prerequisites'] = $arr['prerequisites']->pluck('id')->all();
            } elseif (is_iterable($arr['prerequisites'])) {
                $temp = [];
                foreach ($arr['prerequisites'] as $p) {
                    if (is_object($p) && isset($p->id)) $temp[] = $p->id;
                    elseif (is_array($p) && isset($p['id'])) $temp[] = $p['id'];
                    else $temp[] = $p;
                }
                $arr['prerequisites'] = array_values($temp);
            } else {
                $arr['prerequisites'] = [];
            }
        } else {
            $arr['prerequisites'] = [];
        }

        // Standard keys
        $arr['id'] = $arr['id'] ?? ($arr['ID'] ?? null);
        $arr['nama'] = $arr['nama'] ?? ($arr['name'] ?? ($arr['title'] ?? ''));
        $arr['kode'] = $arr['kode'] ?? ($arr['code'] ?? '');
        $arr['sks'] = $arr['sks'] ?? null;
        $arr['semester'] = $arr['semester'] ?? null;

        return $arr;
    }, $coursesArr);

    // Build id => course map
    $courseMap = [];
    foreach ($normalized as $c) {
        if (!isset($c['id'])) continue;
        $courseMap[$c['id']] = $c;
    }

    // Rekursif render function (mengembalikan HTML). Gunakan referensi untuk rekursi.
    $renderPrereq = function($courseId, array &$courseMap, callable &$renderPrereq, $visited = []) {
        if (!isset($courseMap[$courseId])) {
            return '<em>(prasyarat tidak ditemukan)</em>';
        }

        if (in_array($courseId, $visited, true)) {
            return '<em>(siklus terdeteksi)</em>';
        }

        $course = $courseMap[$courseId];
        $visited[] = $courseId;

        // Jika tidak ada prasyarat, tampilkan node tunggal
        if (empty($course['prerequisites'])) {
            return '<span class="node-label">' . e($course['kode']) . ' — ' . e($course['nama']) . '</span>';
        }

        $out = '<div class="node-with-children">';
        $out .= '<div class="node-label root">' . e($course['kode']) . ' — ' . e($course['nama']) . '</div>';
        $out .= '<ul class="tree">';
        foreach ($course['prerequisites'] as $pid) {
            $out .= '<li>';
            if (isset($courseMap[$pid])) {
                $out .= $renderPrereq($pid, $courseMap, $renderPrereq, $visited);
            } else {
                $out .= '<span class="node-label missing">(id:' . e($pid) . ') tidak ditemukan</span>';
            }
            $out .= '</li>';
        }
        $out .= '</ul>';
        $out .= '</div>';

        return $out;
    };

    // Jika tidak ada course sama sekali, buat map kosong
    if (empty($courseMap)) {
        $allPrereqIds = [];
        $roots = [];
    } else {
        // Kumpulkan semua id yang muncul sebagai prasyarat
        $allPrereqIds = [];
        foreach ($courseMap as $c) {
            if (!empty($c['prerequisites']) && is_array($c['prerequisites'])) {
                foreach ($c['prerequisites'] as $p) {
                    $allPrereqIds[] = $p;
                }
            }
        }
        $allPrereqIds = array_values(array_unique($allPrereqIds));

        // Roots = course yang tidak muncul sebagai prasyarat
        $roots = [];
        foreach ($courseMap as $id => $c) {
            if (!in_array($id, $allPrereqIds, true)) {
                $roots[$id] = $c;
            }
        }
        if (empty($roots)) {
            // fallback: tampilkan semua jika tidak ada root (mis. siklus penuh)
            $roots = $courseMap;
        }
    }

    // helper kecil untuk menampilkan jumlah courses (dipakai di ringkasan)
    $totalCourses = count($courseMap);
@endphp

<style>
    /* Print-friendly page setup */
    @page { margin: 15mm 12mm; }
    @media print {
        .card.root-page { page-break-after: always; }
        .card { page-break-inside: avoid; -webkit-region-break-inside: avoid; }
    }
    body, .card, .node-label {
    font-family: "DejaVu Sans", "Arial", sans-serif;
}

    /* Tree styling */
    .tree { list-style: none; margin: 0; padding-left: 1.25rem; position: relative; }
    .tree:before { content: ''; position: absolute; left: 0.5rem; top: 0; bottom: 0; width: 1px; background: #e5e7eb; }
    .tree > li { margin: 0.5rem 0; padding-left: 0.75rem; position: relative; }
    .tree > li:before { content: ''; position: absolute; left: -0.05rem; top: 0.9rem; width: 0.75rem; height: 1px; background: #e5e7eb; }

    .node-label { display: inline-block; padding: .35rem .5rem; border-radius: 6px; background: #f8fafc; border: 1px solid #e6eef8; color: #0f172a; font-size: 0.9rem; line-height: 1.2; }
    .node-label.root { background: #eef2ff; border-color: #c7d2fe; font-weight: 600; }
    .node-label.missing { background: #fff7f7; border-color: #fecaca; color: #991b1b; font-style: italic; }
    .container-roots { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1rem; }
    .card { padding: 0.75rem; border-radius: 8px; background: #ffffff; border: 1px solid #e6e6e6; box-shadow: 0 1px 2px rgba(0,0,0,0.03); }
    .card h4 { margin: 0 0 .5rem 0; font-size: 1rem; color: #0f172a; }
    .node-with-children .root { margin-bottom: .5rem; display: inline-block; }
    .meta { font-size: .8rem; color: #6b7280; margin-bottom: .5rem; }
    .controls { display:flex; gap:.5rem; margin-bottom: .75rem; align-items:center; flex-wrap:wrap; }
    .btn { display:inline-block; padding:.45rem .75rem; border-radius:6px; color:white; text-decoration:none; font-size:0.95rem; }
    .btn-pdf { background:#3b82f6; }
    .btn-preview { background:#6b7280; }
</style>

<div class="card">
    <h3 style="margin:0 0 .5rem 0;">{{ $title }}</h3>
    <p class="meta">Arah panah (&rarr;) pada pohon menunjukkan prasyarat: prasyarat &rarr; mata kuliah tujuan.</p>


    {{-- Kontrol: unduh PDF / preview --}}
    <div class="controls">
        {{-- pastikan route sesuai di aplikasi Anda --}}
        <a href="{{ route('course-tree.pdf') . '?major=' . urlencode('Sistem Informasi') }}"
       target="_blank"
       style="background:#0ea5e9;color:white;padding:0.45rem .7rem;border-radius:6px;text-decoration:none;">
       📄 PDF — Sistem Informasi
    </a>

    <a href="{{ route('course-tree.pdf') . '?major=' . urlencode('Teknik Informatika') }}"
       target="_blank"
       style="background:#f97316;color:white;padding:0.45rem .7rem;border-radius:6px;text-decoration:none;">
       📄 PDF — Teknik Informatika
    </a>
        <a href="{{ route('course-tree.preview') }}" target="_blank" class="btn btn-preview">🔍 Preview HTML</a>
    </div>

    {{-- Jika tidak ada data, tampilkan pesan --}}
    @if($totalCourses === 0)
        <div style="padding:1rem; background:#fffbeb; border:1px solid #fef3c7; border-radius:6px; color:#92400e;">
            Tidak ada data mata kuliah untuk ditampilkan.
        </div>
    @else
        <div class="container-roots">
            @foreach ($roots as $root)
                {{-- tambahkan class root-page bila ingin tiap root berada di halaman terpisah saat print --}}
                <div class="card root-page" style="background:#fbfbff;">
                    <h4>{{ $root['kode'] }} — {{ $root['nama'] }}</h4>
                    <div class="meta">Semester: {{ $root['semester'] ?? '-' }} &middot; SKS: {{ $root['sks'] ?? '-' }}</div>
                    <div class="tree-wrapper">
                        {!! $renderPrereq($root['id'], $courseMap, $renderPrereq, []) !!}
                    </div>
                </div>
            @endforeach
        </div>

        <hr style="margin:1rem 0; border-color:#eef2ff;">
        <div style="font-size: .9rem; color:#475569;">
            <strong>Ringkasan:</strong> total mata kuliah <strong>{{ $totalCourses }}</strong>.
            Roots (mata kuliah yang tidak jadi prasyarat course lain): <strong>{{ count($roots) }}</strong>.
        </div>
    @endif

</div>
