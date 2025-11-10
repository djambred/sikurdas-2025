<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Matriks Mapping PL ke CPL</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11.5px;
            color: #222;
            margin: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header img {
            height: 60px;
            margin-bottom: 5px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0;
        }
        .header h2 {
            font-size: 14px;
            margin: 3px 0 10px 0;
            font-weight: normal;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px 6px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }
        th {
            background-color: #e8eef8;
            font-weight: bold;
            font-size: 11px;
        }
        tr:nth-child(even) td {
            background-color: #f9fbff;
        }
        .pl-col {
            background-color: #eef2ff;
            font-weight: bold;
            text-align: center;
            width: 80px;
        }
        .desc {
            text-align: left;
            width: 220px;
        }
        .checked {
            background-color: #d9f8d9;
            font-weight: bold;
            color: #006600;
        }
        .unchecked {
            background-color: #ffffff;
        }
        footer {
            margin-top: 25px;
            font-size: 10px;
            text-align: right;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        {{-- Ganti path logo sesuai kampusmu, atau hapus jika tidak perlu --}}
        {{-- <img src="{{ public_path('logo.png') }}" alt="Logo Kampus"> --}}
        <h1>UNIVERSITAS CONTOH INDONESIA</h1>
        <h2>Matriks Keterkaitan Profil Lulusan (PL) dan Capaian Pembelajaran Lulusan (CPL)</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode PL</th>
                <th>Deskripsi Profil Lulusan</th>
                @foreach ($outcomes as $cpl)
                    <th>{{ $cpl->code }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $pl)
                <tr>
                    <td class="pl-col">{{ $pl->code }}</td>
                    <td class="desc">{{ $pl->description }}</td>
                    @foreach ($outcomes as $cpl)
                        @php
                            $isMapped = $relations->where('graduate_profile_id', $pl->id)
                                ->where('learning_outcome_id', $cpl->id)
                                ->count() > 0;
                        @endphp
                        <td class="{{ $isMapped ? 'checked' : 'unchecked' }}">
                            {{ $isMapped ? '✓' : '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Dicetak pada {{ now()->format('d F Y, H:i') }}
    </footer>
</body>
</html>
