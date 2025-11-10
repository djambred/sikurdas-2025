<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - {{ $rps->nama ?? 'Rencana Pembelajaran Semester' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.4;
            font-size: 10pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .university {
            font-size: 12pt;
            font-weight: bold;
        }
        .title {
            font-size: 14pt;
            font-weight: bold;
            margin: 8px 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 9pt;
        }
        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        .info-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .section {
            margin: 20px 0;
            page-break-inside: avoid;
        }
        .section-title {
            background: #d9d9d9;
            padding: 6px 10px;
            font-weight: bold;
            border: 1px solid #000;
            margin-bottom: 8px;
            font-size: 11pt;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 8pt;
        }
        .content-table th, .content-table td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: left;
            vertical-align: top;
        }
        .content-table th {
            background-color: #e6e6e6;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .page-break { page-break-after: always; }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="university">UNIVERSITAS ESA UNGGUL FAKULTAS ILMU KOMPUTER SISTEM INFORMASI</div>
        <div class="title">RENCANA PEMBELAJARAN SEMESTER</div>
    </div>

    <!-- Informasi Mata Kuliah -->
    <table class="info-table">
        <tr>
            <th width="20%">Mata Kuliah (MK)</th>
            <td width="30%">{{ $rps->nama ?? '' }}</td>
            <th width="15%">Kode</th>
            <td width="35%">{{ $rps->kode ?? '' }}</td>
        </tr>
        <tr>
            <th>Rumpun MK</th>
            <td>Ilmu Komputer</td>
            <th>Bobot (SKS)</th>
            <td>T={{ $rps->sks ?? '' }} P=0</td>
        </tr>
        <tr>
            <th>Semester</th>
            <td>{{ $rps->semester ?? '' }}</td>
            <th>Tgl Penyusunan</th>
            <td>{{ $rps->tanggal_penyusunan ? \Carbon\Carbon::parse($rps->tanggal_penyusunan)->format('d F Y') : '' }}</td>
        </tr>
        <tr>
            <th>Otorisasi</th>
            <td colspan="3">
                <table width="100%" style="border: none;">
                    <tr>
                        <td width="33%" style="border: none; text-align: center;">
                            <strong>Pengembang RPS</strong><br>
                            {{ $rps->penyusun ?? 'ANIK HAMIDAH AZIZAH, S.Kom, M.IM' }}
                        </td>
                        <td width="33%" style="border: none; text-align: center;">
                            <strong>Koordinator RPS</strong><br>
                            {{ $rps->koordinator_rps ?? 'ANIK HAMIDAH AZIZAH, S.Kom, M.IM' }}
                        </td>
                        <td width="33%" style="border: none; text-align: center;">
                            <strong>Ketua Prodi</strong><br>
                            {{ $rps->ketua_prodi ?? 'ANIK HAMIDAH AZIZAH, S.Kom, M.IM' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Capaian Pembelajaran -->
    <div class="section">
        <div class="section-title">Capaian Pembelajaran (CP)</div>

        <div style="margin-bottom: 15px;">
            <strong>CPL-PRODI yang dibebankan pada Mata Kuliah</strong>
        </div>

        <table class="content-table">
            <tr>
                <th width="10%">Kode</th>
                <th>Deskripsi</th>
            </tr>
            <tr>
                <td>KU1</td>
                <td>Mampu menerapkan pemikiran logis, kritis, sistematis, dan inovatif dalam mengembangkan dan mengimplementasikan teknologi informasi dengan menerapkan nilai kebalkan yang terkait dengan keahlian sistem informasi</td>
            </tr>
            <tr>
                <td>PP1</td>
                <td>Memahami konsep teoritis sistem informasi secara umum dan konsep teoritis dalam bisnis, tata kelola sistem informasi, dan management pengembangan sistem informasi</td>
            </tr>
        </table>

        <div style="margin: 15px 0;">
            <strong>Capaian Pembelajaran Mata Kuliah (CPMK)</strong>
        </div>

        <table class="content-table">
            <tr>
                <th width="10%">Kode</th>
                <th>Deskripsi</th>
            </tr>
            @foreach($rps->cpmks ?? [] as $cpmk)
            <tr>
                <td>{{ $cpmk->code ?? 'CPMK' . ($loop->iteration) }}</td>
                <td>{{ $cpmk->description ?? '' }}</td>
            </tr>
            @endforeach
            @if(empty($rps->cpmks))
            <tr>
                <td>CPMK1</td>
                <td>Mahasiswa Mampu membuat Portofolio Enterprise Arsitektur yang mendukung Keselarasan Bisnis dan Teknologi informasi (KU1)</td>
            </tr>
            <tr>
                <td>CPMK2</td>
                <td>Mahasiswa Mampu menghasilkan Roadmap Enterprise Arsitektur sebagai usulan rekomendasi rencana strategis jangka panjang</td>
            </tr>
            <tr>
                <td>CPMK3</td>
                <td>Mahasiswa Mampu menganalisis dan mengevaluasi Capabilities Model EA di perusahaan / pemerintahan</td>
            </tr>
            <tr>
                <td>CPMK4</td>
                <td>Mahasiswa Mampu merancang dan menerapkan Model Enterprise Architecture sesuai dengan model kerangka kerja EA</td>
            </tr>
            @endif
        </table>

        <div style="margin: 15px 0;">
            <strong>Kemampuan Akhir Tiap Tahapan Belajar (Sub-CPMK)</strong>
        </div>

        <table class="content-table">
            <tr>
                <th width="10%">Kode</th>
                <th>Deskripsi</th>
            </tr>
            @foreach($rps->subCpmks ?? [] as $subCpmk)
            <tr>
                <td>{{ $subCpmk->code ?? 'Sub-CPMK' . ($loop->iteration) }}</td>
                <td>{{ $subCpmk->detail ?? '' }}</td>
            </tr>
            @endforeach
            @if(empty($rps->subCpmks))
            <!-- Default Sub-CPMK dari contoh -->
            <tr>
                <td>Sub-CPMK1</td>
                <td>Mahasiswa mampu menguraikan definisi EA, pemanfaatan EA, dan meningkatnya kesadaran mengenai pentingnya EA dalam organisasi (CPMK1) (Pertemuan 1)</td>
            </tr>
            <tr>
                <td>Sub-CPMK2</td>
                <td>Mahasiswa mampu mengenai framework EA dan penerapannya di sebuah perusahaan / pemerintahan (Pertemuan 2)</td>
            </tr>
            <tr>
                <td>Sub-CPMK3</td>
                <td>Mahasiswa mampu menganalisis penyelarasan IT dengan Bisnis Proses di sebuah perusahaan / pemerintahan (Pertemuan 3)</td>
            </tr>
            <!-- Tambahkan lebih banyak sesuai kebutuhan -->
            @endif
        </table>
    </div>

    <!-- Deskripsi Singkat -->
    <div class="section">
        <div class="section-title">Deskripsi Singkat MK</div>
        <p>{{ $rps->deskripsi_singkat ?? 'Mata kuliah tentang arsitektur enterprise meliputi : definisi, latar belakang, tujuan, manfaat dan ruang lingkup arsitektur enterprise. Pilar pendukung arsitektur enterprise yang meliputi : arsitektur bisnis, data, aplikasi dan teknologi, komponen detail tiap pilar arsitektur dan keterkaitannya satu sama lain. Framework, tools dan aplikasi pendukung untuk menyusun arsitektur bisnis, informasi/data, dan teknologi. Pengenalan solusi sistem dan teknologi terkini yang umum digunakan dalam penyusunan arsitektur enterprise, misalnya data center, distributed computing, middleware, enterprise architecture integration, service oriented architecture, agile architecture, dll' }}</p>
    </div>

    <!-- Bahan Kajian / Materi Pembelajaran -->
    <div class="section">
        <div class="section-title">Bahan Kajian / Materi Pembelajaran</div>

        <div style="margin-bottom: 10px;">
            <strong>Pustaka</strong>
        </div>

        <div style="margin-bottom: 5px;">
            <strong>Utama :</strong>
        </div>
        <ol>
            <li>The Open Group The Open Group Architecture Framework (TOGAF) Version 9.1, Enterprise Edition</li>
            <li>Materi Kuliah Dosen MK Enterprise Architecture</li>
        </ol>

        <div style="margin: 10px 0 5px 0;">
            <strong>Pendukung :</strong>
        </div>
        <ol>
            <li>McCovers, James W. Ambler, Scott Stevens, Michael E., A Practical Guide to Enterprise Architect, Prentice Hall, 2013.</li>
            <li>TOGAF® 9 Certified Study Guide (TOGAF Series), The Open Group</li>
            <li>Zachman, John, The Framework for Enterprise Architecture: Background, Description and Utility</li>
            <li>Lubis, M., & Azizah, A. H. (2018). Towards achieving the efficiency in zakat management system: Interaction design for optimization in Indonesia. In User Science and Engineering-5th International Conference, i-USEr 2018, Puchong, Malaysia, August 29–30, 2018, Proceedings 5 (pp. 289–301). Springer Singapore</li>
            <li>Lubis, M., Wirjiskosno, W., & Azizah, A. H. (2018). Semester, Implementation of enterprise resource planning (EERP) using integrated model of extended technology acceptance model (TAM) 2: case study of PT. Toyota Astra motor. In 2019 7th International Conference on Cyber and IT Service Management (CITSM) (Vol. 7, pp. 1-6). IEEE.</li>
            <li>ASU Repository: Development of Architecture Enterprise and its Case Studies</li>
        </ol>
    </div>

    <!-- Dosen Pengampu -->
    <div class="section">
        <div class="section-title">Dosen Pengampu</div>
        <p>{{ $rps->dosen_pengampu ?? 'ADI WIDJANTONO, S.Kom, M.Kom; BADIE UDDIN, S.T., S.Kom., M.Kom; Dr. Ir. GERRY FIRMANSYAH, S.T., M.Kom; MUHAMAD SOBRI, S.SI, M.T' }}</p>
    </div>

    <!-- Mata Kuliah Syarat -->
    <div class="section">
        <div class="section-title">Mata Kuliah Syarat</div>
        <p>{{ $rps->mata_kuliah_syarat ?? '-' }}</p>
    </div>

    <!-- Rencana Pembelajaran Mingguan -->
    <div class="section">
        <div class="section-title">Rencana Pembelajaran Mingguan</div>

        <table class="content-table">
            <thead>
                <tr>
                    <th rowspan="2" width="4%">Mg Ke-</th>
                    <th rowspan="2" width="15%">Sub-CPMK (Kemampuan akhir tiap tahapan belajar)</th>
                    <th colspan="2" width="20%">Penilaian</th>
                    <th rowspan="2" width="8%">Bentuk Pembelajaran</th>
                    <th rowspan="2" width="12%">Metode Pembelajaran</th>
                    <th rowspan="2" width="15%">Rencana Tugas Mahasiswa (RTM)</th>
                    <th rowspan="2" width="16%">Materi Pembelajaran [Pustaka]</th>
                    <th rowspan="2" width="10%">Bobot Penilaian (%)</th>
                </tr>
                <tr>
                    <th width="10%">Indikator</th>
                    <th width="10%">Kriteria & Bentuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rps->weekly_plan ?? [] as $week)
                <tr>
                    <td class="text-center">{{ $week['week'] ?? $loop->iteration }}</td>
                    <td>{{ $week['sub_cpmk'] ?? '' }}</td>
                    <td>{{ $week['indikator'] ?? '' }}</td>
                    <td>{{ $week['kriteria_bentuk'] ?? '' }}</td>
                    <td>{{ $week['bentuk_pembelajaran'] ?? '' }}</td>
                    <td>{{ $week['metode_pembelajaran'] ?? '' }}</td>
                    <td>{{ $week['rtm'] ?? '' }}</td>
                    <td>{{ $week['materi_pembelajaran'] ?? '' }}</td>
                    <td class="text-center">{{ $week['bobot'] ?? '' }}</td>
                </tr>
                @endforeach

                @if(empty($rps->weekly_plan))
                <!-- Contoh data dari RPS asli -->
                <tr>
                    <td class="text-center">1</td>
                    <td>Mahasiswa mampu menguraikan definisi EA, pemanfaatan EA, dan meningkatnya kesadaran mengenai pentingnya EA dalam organisasi (Sub-CPMK1)</td>
                    <td>Mahasiswa mampu menjelaskan peran/signifikansi perkembangan arsitektur enterprise</td>
                    <td>Kriteria : Rubrik Deskriptif Bentuk Test : Presentasi</td>
                    <td>Kuliah</td>
                    <td>Pembelajaran Kolaboratif, Presentasi mahasiswa dalam kelas [PB:1mpx(3skxs50")]</td>
                    <td>Kuis, Aktifitas partisipasif [PT:1mpx(3skxs60")] [KM:1x(3x60")]</td>
                    <td>Pengertian, definisi, latar belakang, tujuan, prinsip dan model Enterprise Architecture - Ruang Lingkup dan arsitektur pendukung implementasi Enterprise Architecture - Perkembangan Konsep dan implementasi Enterprise Architecture Saat ini</td>
                    <td class="text-center">10</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Mahasiswa mampu mengenai framework EA dan penerapannya di sebuah perusahaan / pemerintahan (Sub-CPMK2)</td>
                    <td>Mahasiswa mampu menjelaskan peran/signifikansi perkembangan arsitektur enterprise</td>
                    <td>Kriteria : Rubrik Deskriptif Bentuk Test : Presentasi</td>
                    <td>Kuliah</td>
                    <td>Pembelajaran Kolaboratif, Presentasi mahasiswa dalam kelas [PB:1mpx(3skxs50")]</td>
                    <td>Kuis, Aktifitas partisipasif [PT:1mpx(3skxs60")] [KM:1x(3x60")]</td>
                    <td>Pengertian, definisi, latar belakang, tujuan, prinsip dan model Enterprise Architecture - Ruang Lingkup dan arsitektur pendukung implementasi Enterprise Architecture - Perkembangan Konsep dan implementasi Enterprise Architecture Saat ini</td>
                    <td class="text-center">10</td>
                </tr>
                <!-- Tambahkan minggu lainnya sesuai kebutuhan -->
                @endif
            </tbody>
        </table>
    </div>

    <!-- Evaluasi Akhir Semester -->
    <div class="section">
        <div class="section-title">Evaluasi Akhir Semester / Ujian Akhir Semester</div>
        <p>Evaluasi akhir semester dilaksanakan sesuai dengan jadwal akademik yang ditetapkan oleh universitas.</p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-box">
            Mengetahui,<br>
            Koordinator Program Studi<br>
            <div class="signature-line"></div>
            {{ $rps->ketua_prodi ?? 'ANIK HAMIDAH AZIZAH, S.Kom, M.IM' }}
        </div>
        <div class="signature-box">
            Penyusun,<br><br>
            <div class="signature-line"></div>
            {{ $rps->penyusun ?? 'ANIK HAMIDAH AZIZAH, S.Kom, M.IM' }}
        </div>
    </div>

</body>
</html>
