<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Preview Mapping PL ke CPL</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            background: #f8f9fa;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 30px;
        }

        .pl-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .pl-header {
            background: #e7f1ff;
            border-left: 5px solid #007bff;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .pl-description {
            margin-bottom: 15px;
            color: #555;
        }

        .cpl-list {
            margin-left: 30px;
            padding-left: 15px;
            border-left: 3px solid #007bff;
        }

        .cpl-item {
            background: #f0f7ff;
            border: 1px solid #cfe2ff;
            border-radius: 6px;
            margin: 6px 0;
            padding: 8px 10px;
        }

        .ik-list {
            margin-left: 25px;
            padding-left: 15px;
            border-left: 2px dashed #69a2ff;
        }

        .ik-item {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin: 5px 0;
            padding: 6px 10px;
            font-size: 14px;
        }

        .empty {
            color: #888;
            font-style: italic;
        }

        .actions {
            text-align: center;
            margin-top: 40px;
        }

        a.download-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 18px;
            background: #28a745;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }

        a.download-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <h2>Matriks Relasi Profil Lulusan (PL) → Capaian Pembelajaran (CPL) → Indikator (IK)</h2>

    @foreach ($profiles as $pl)
        @php
            $relatedCPLs = $relations->where('graduate_profile_id', $pl->id);
        @endphp

        <div class="pl-box">
            <div class="pl-header">{{ $pl->code }} — {{ $pl->name ?? '' }}</div>
            <div class="pl-description">{{ $pl->description }}</div>

            <div class="cpl-list">
                @if ($relatedCPLs->count() > 0)
                    @foreach ($relatedCPLs as $rel)
                        @php
                            $cpl = $outcomes->firstWhere('id', $rel->learning_outcome_id);
                        @endphp
                        @if ($cpl)
                            <div class="cpl-item">
                                <b>{{ $cpl->code }}</b> — {{ $cpl->description }}

                                @php
                                    $indicators = $cpl->indicators ?? collect();
                                @endphp

                                <div class="ik-list">
                                    @if ($indicators->count() > 0)
                                        @foreach ($indicators as $ik)
                                            <div class="ik-item">
                                                <b>{{ $ik->code }}</b> — {{ $ik->description }}
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="empty">Belum ada indikator untuk CPL ini.</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="empty">Tidak ada CPL yang terkait.</p>
                @endif
            </div>
        </div>
    @endforeach

</body>
</html>
