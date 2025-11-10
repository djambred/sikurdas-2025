{{-- resources/views/filament/custom/course-tree-blade-only.blade.php --}}
@props([
    'title' => 'Struktur Mata Kuliah',
    'courses',
    'forPdf' => false, // Default: False (mode HTML)
    'major' => null,   // Data Major (opsional, object/array)
])

@php
// --- 1. NORMALISASI DATA ---
$coursesArr = $courses instanceof \Illuminate\Support\Collection ? $courses->values()->all() : ($courses ?: []);

$normalized = array_map(function($c){
    $arr = is_object($c) ? (method_exists($c,'toArray')?$c->toArray():(array)$c) : (array)$c;

    // *** PERBAIKAN: Akses nama major dengan lebih aman ***
    $arr['major'] = $c['major']['name'] ?? $arr['major']['name'] ?? 'Major Tidak Diketahui';

    $arr['prerequisites'] = [];
    if(!empty($c['prerequisites'])){
        foreach($c['prerequisites'] as $p){
            if(is_object($p) && isset($p->id)) $arr['prerequisites'][] = $p->id;
            elseif(is_array($p) && isset($p['id'])) $arr['prerequisites'][] = $p['id'];
            else $arr['prerequisites'][] = $p;
        }
    }
    // Normalisasi Tags (PL, CPL, IK, CPMK)
    foreach(['pl','cpl','ik','cpmk'] as $key){
        $arr[$key] = collect($c[$key] ?? [])->map(fn($x)=> $x['description'] ?? '')->filter()->all();
    }
    return $arr;
}, $coursesArr);

$courseMap = [];
foreach($normalized as $c){
    if(isset($c['id'])) $courseMap[$c['id']] = $c;
}

// --- 2. FUNGSI REKURSIF UNTUK MERENDER TREE ---
$renderPrereq = null;
$renderPrereq = function($courseId, array &$courseMap, $visited=[], $isPrerequisite=false) use (&$renderPrereq){
    if(!isset($courseMap[$courseId])) {
        return '<div class="node-label error"><em>(Prasyarat ID: '.$courseId.' tidak ditemukan)</em></div>';
    }

    $course = $courseMap[$courseId];
    $isCycle = in_array($courseId, $visited, true);
    $visited[] = $courseId;

    $out = '<div class="node-with-children">';

    // --- LABEL MATA KULIAH (NODE) ---
    $labelClass = $isCycle ? 'cycle-detected' : (empty($course['prerequisites']) ? 'no-prereq' : 'has-prereq');
    $out .= '<div class="node-label '.e($labelClass).'">';
    $out .= '<span class="course-code">'.e($course['kode']).'</span> &mdash; <span class="course-name">'.e($course['nama']).'</span>';
    if($isCycle) $out .= '<span class="cycle-tag">! Siklus</span>';
    $out .= '</div>';

    // --- TAGS (PL, CPL, CPMK, IK) ---
    $tagsOutput = '';

    if (!$isPrerequisite) {
        $tagColors = ['pl'=>'--color-pl','cpl'=>'--color-cpl','ik'=>'--color-ik','cpmk'=>'--color-cpmk'];

        foreach(['PL'=>'pl','CPL'=>'cpl','CPMK'=>'cpmk','IK'=>'ik'] as $label=>$key){
            if(!empty($course[$key])){
                foreach($course[$key] as $item){
                    $shortItem = $item;
                    $tagsOutput .= '<span class="tag" style="background: var('.$tagColors[$key].')!important;" title="'.e($item).'">'.e($label).': '.e($shortItem).'</span> ';
                }
            }
        }
    }

    if($tagsOutput) $out .= '<div class="tags-container full-text">'.$tagsOutput.'</div>';

    // --- REKURSIF PRASYARAT (TREE LIST) ---
    if(!empty($course['prerequisites']) && !$isCycle){
        $out .= '<div class="prereq-label">Mata Kuliah Prasyarat:</div>';

        $out .= '<ul class="tree">';
        foreach($course['prerequisites'] as $pid){
            $out .= '<li>'.$renderPrereq($pid,$courseMap,$visited, true).'</li>';
        }
        $out .= '</ul>';
    } elseif ($isCycle) {
        $out .= '<div class="cycle-message">Prasyarat mata kuliah ini: '.e($course['kode']).' (Siklus dihentikan)</div>';
    }

    $out .= '</div>';
    return $out;
};

// --- 3. GROUPING BERDASARKAN SEMESTER DAN MAJOR ---
$groupedCourses = collect($normalized)
    ->groupBy('semester')
    ->sortKeys()
    ->map(function ($semesterCourses) {
        // Grouping berdasarkan major Name yang sudah dinormalisasi di atas
        return $semesterCourses->groupBy('major')->sortKeys();
    });

$totalCourses = count($courseMap);
@endphp

{{-- ---------------------------------------------------------------- --}}
{{-- STYLING (Tidak ada perubahan) --}}
{{-- ---------------------------------------------------------------- --}}
<style>
    /* ... (CSS Styling Tetap Sama) ... */
    :root {
        --color-main: #4f46e5;
        --color-bg-light: #f9fafb;
        --color-border: #e5e7eb;
        --color-pl: #dbeafe; /* Blue Light */
        --color-cpl: #d1fae5; /* Green Light */
        --color-ik: #fef3c7; /* Yellow Light */
        --color-cpmk: #fee2e2; /* Red Light */
        --color-cycle: #fca5a5;
        --color-header-bg: #e0e7ff; /* Blue 100 untuk header collapse */
    }

    .custom-card-tree {
        padding: 1.5rem;
        background-color: var(--color-bg-light);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--color-main);
    }
    .header-container h3 {
        margin: 0;
        font-size: 1.5rem;
        color: var(--color-main);
    }
    .download-button {
        padding: 0.5rem 1rem;
        background-color: var(--color-main);
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .download-button:hover {
        background-color: #4338ca;
    }

    /* Tambahan Styling untuk Label Prasyarat */
    .prereq-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #4b5563;
        margin-top: 0.5rem;
        margin-bottom: 0.25rem;
        padding-left: 0.5rem;
    }

    /* Node Rendering */
    .tree-container {
        margin-top: 0.5rem;
        padding-left: 0.5rem;
        border-left: 1px dashed var(--color-border);
    }
    .tree {
        list-style: none;
        padding-left: 1.25rem;
        margin: 0.5rem 0;
    }
    .tree li {
        position: relative;
        margin-left: -0.5rem;
        padding-left: 0.5rem;
        line-height: 1.5;
    }
    .tree li:not(:last-child) {
        border-left: 1px dashed var(--color-border);
    }
    .tree li:before {
        content: '';
        position: absolute;
        top: 0.75em;
        left: -1px;
        width: 0.5rem;
        height: 1px;
        border-top: 1px dashed var(--color-border);
    }
    .node-label {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.85rem;
        display: inline-block;
        font-weight: 500;
        margin-bottom: 0.25rem;
        border: 1px solid transparent;
    }
    .node-label.has-prereq {
        background-color: #f0f9ff;
        border-color: #bfdbfe;
    }
    .node-label.no-prereq {
        background-color: #f0fdf4;
        border-color: #dcfce7;
    }
    .node-label.cycle-detected {
        background-color: var(--color-cycle);
        border-color: #f87171;
    }
    .cycle-tag {
        font-size: 0.75rem;
        color: #ef4444;
        margin-left: 0.5rem;
        font-weight: 700;
    }
    .cycle-message {
        font-size: 0.75rem;
        color: #ef4444;
        margin-left: 0.5rem;
        margin-top: 0.25rem;
        font-style: italic;
    }

    /* Tags Styling - Full Text */
    .tags-container.full-text {
        padding: 0.25rem 0.5rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background-color: #ffffff;
        line-height: 1.4;
        max-height: none;
        overflow: visible;
    }
    .tag {
        display: inline-block;
        padding: 2px 5px;
        margin: 2px 5px 2px 0;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #1f2937;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        white-space: normal;
    }

    /* Root Card Styling */
    .container-roots-in-collapse {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .root-card-item {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 1rem;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .root-card-item h4 {
        font-size: 1.1rem;
        color: #1f2937;
        margin-top: 0;
        margin-bottom: 0.25rem;
        font-weight: 700;
    }
    .root-card-item .meta {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
        border-bottom: 1px dashed #f3f4f6;
        padding-bottom: 0.5rem;
    }

    /* === Collapsible Section Styles === */
    .semester-collapse {
        margin-bottom: 1.5rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        overflow: hidden;
    }
    .collapse-toggle {
        display: none;
    }
    .collapse-header {
        display: block;
        padding: 0.75rem 1rem;
        background-color: var(--color-header-bg);
        color: #3730a3;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        user-select: none;
        position: relative;
    }
    .collapse-header::after {
        content: '▼';
        position: absolute;
        right: 1rem;
        transition: transform 0.2s;
    }

    .collapse-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out, padding 0.3s;
        padding: 0 1rem;
    }
    .collapse-toggle:checked + .collapse-header::after {
        content: '▲';
        transform: rotate(180deg);
    }
    .collapse-toggle:checked ~ .collapse-content {
        max-height: 5000px;
        padding: 1rem;
    }

    /* Tampilan di PDF (All Expanded) */
    @if ($forPdf)
    .semester-collapse {
        border: none;
        border-bottom: 1px dashed #d1d5db;
        border-radius: 0;
        margin-bottom: 1rem;
    }
    .collapse-header {
        background-color: #f3f4f6;
        color: #1f2937;
        cursor: default;
    }
    .collapse-header::after {
        display: none;
    }
    .collapse-content {
        max-height: none !important;
        padding: 1rem 0 0.5rem 0 !important;
        overflow: visible;
    }
    .collapse-toggle {
        display: block;
    }
    .collapse-toggle[type="checkbox"] {
        opacity: 0;
        height: 0;
        margin: 0;
    }
    .collapse-toggle:not(:checked) + .collapse-header + .collapse-content {
        max-height: none !important;
        padding: 1rem 0 0.5rem 0 !important;
    }
    @endif

    .major-group-section {
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .major-group-section:last-child {
        border-bottom: none;
    }
    .major-group-section h5 {
        font-size: 1rem;
        color: #4b5563;
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-weight: 600;
        padding: 0.5rem 0;
    }
</style>

{{-- ---------------------------------------------------------------- --}}
{{-- MARKUP UNTUK TAMPILAN --}}
{{-- ---------------------------------------------------------------- --}}
<div class="custom-card-tree">
    <div class="header-container">
        <h3>{{ $title }}</h3>

        {{-- Tombol PDF hanya tampil di mode HTML --}}
        @if (empty($forPdf))
            @php
                $majorParam = $major ? ($major->id ?? \Str::slug($major->name ?? 'all')) : null;
                $downloadUrl = route('course-tree.pdf', ['major' => $majorParam]);
            @endphp
            <a href="{{ $downloadUrl }}" class="download-button" target="_blank" title="Unduh struktur ini sebagai dokumen PDF">
                ⬇️ Unduh PDF Lengkap
            </a>
        @endif
    </div>

    {{-- *** TAMPILAN HEADER MAJOR HANYA DI BAGIAN ATAS *** --}}
    @php
        // Tentukan nama Program Studi yang ditampilkan
        $displayedMajorName = $major ? ($major->name ?? 'Program Studi Tidak Dikenal') : 'Semua Program Studi';
    @endphp
    @if (empty($forPdf))
        <div class="meta" style="margin-top: -0.5rem; margin-bottom: 0.75rem; font-size:1rem; color:#475569;">
            Program Studi yang Ditampilkan: **{{ $displayedMajorName }}**
        </div>
    @endif

    {{-- === LOOP COLLAPSIBLE PER SEMESTER === --}}
    @forelse ($groupedCourses as $semester => $majorGroups)
        @php
            $id = \Str::slug("semester-$semester" . ($major->name ?? 'all'));
            $checked = $forPdf ? 'checked' : '';
        @endphp

        <div class="semester-collapse">
            <input type="checkbox" id="{{ $id }}" class="collapse-toggle" {{ $checked }}>
            <label for="{{ $id }}" class="collapse-header">
                SEMESTER {{ $semester }}
            </label>

            <div class="collapse-content">
                {{-- Loop Sub-Grouping per Major (TIDAK ADA HEADER LAGI DI SINI) --}}
                @foreach ($majorGroups as $majorName => $coursesByMajor)
                    <div class="major-group-section">
                        {{-- !!! SUB-HEADER MAJOR DIHILANGKAN SESUAI PERMINTAAN USER !!! --}}
                        {{-- Hapus: <h5>Program Studi: **{{ $majorName }}**</h5> --}}

                        <div class="container-roots-in-collapse">
                            {{-- Render setiap mata kuliah --}}
                            @foreach ($coursesByMajor as $course)
                                @php
                                    $c = $courseMap[$course['id']];
                                @endphp
                                <div class="root-card-item">
                                    <h4>{{ $c['kode'] }} — {{ $c['nama'] }}</h4>
                                    <div class="meta">
                                        Semester: {{ $c['semester'] ?? '-' }} &middot; SKS: {{ $c['sks'] ?? '-' }}
                                    </div>
                                    <div class="tree-container">
                                        {!! $renderPrereq($c['id'],$courseMap,[], false) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p style="color:#6b7280; font-style:italic;">Tidak ada data mata kuliah yang sesuai kriteria (Major/Semester) untuk ditampilkan.</p>
    @endforelse

    <hr style="border-top: 1px solid var(--color-border); margin:1rem 0;">
    <div class="summary-footer" style="font-size:.85rem; color:#475569;">
        <strong>Ringkasan:</strong> Total mata kuliah yang diproses: **{{ $totalCourses }}**
        {{-- Tampilkan Program Studi di footer, menggunakan variabel yang sudah ditentukan sebelumnya --}}
        @if ($major)
        untuk Program Studi **{{ $displayedMajorName }}**.
        @endif
    </div>
</div>
