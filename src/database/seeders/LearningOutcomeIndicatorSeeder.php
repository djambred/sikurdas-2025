<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningOutcomeIndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('learning_outcome_indicators')->insert([
            // === CPL01 ===
            [
                'learning_outcome_id' => 1,
                'code' => 'CPL01-1A',
                'description' => 'Mengidentifikasi dan menjelaskan permasalahan kompleks dalam sistem informasi organisasi.',
            ],
            [
                'learning_outcome_id' => 1,
                'code' => 'CPL01-1B',
                'description' => 'Menganalisis kebutuhan informasi dan data untuk mendukung proses bisnis organisasi.',
            ],
            [
                'learning_outcome_id' => 1,
                'code' => 'CPL01-1C',
                'description' => 'Mengevaluasi penerapan konsep sistem informasi dalam konteks organisasi nyata.',
            ],
            [
                'learning_outcome_id' => 1,
                'code' => 'CPL01-1D',
                'description' => 'Merumuskan rekomendasi berbasis data untuk mendukung pengambilan keputusan strategis.',
            ],

            // === CPL02 ===
            [
                'learning_outcome_id' => 2,
                'code' => 'CPL02-2A',
                'description' => 'Merancang struktur basis data yang memenuhi prinsip normalisasi dan efisiensi.',
            ],
            [
                'learning_outcome_id' => 2,
                'code' => 'CPL02-2B',
                'description' => 'Menerapkan sistem manajemen basis data (DBMS) untuk pengelolaan data organisasi.',
            ],
            [
                'learning_outcome_id' => 2,
                'code' => 'CPL02-2C',
                'description' => 'Menganalisis data menggunakan teknik analisis kuantitatif dan kualitatif.',
            ],
            [
                'learning_outcome_id' => 2,
                'code' => 'CPL02-2D',
                'description' => 'Mengevaluasi hasil analisis untuk mendukung proses pengambilan keputusan berbasis data.',
            ],

            // === CPL03 ===
            [
                'learning_outcome_id' => 3,
                'code' => 'CPL03-3A',
                'description' => 'Mengidentifikasi kebutuhan pengguna dan proses bisnis organisasi melalui analisis sistem.',
            ],
            [
                'learning_outcome_id' => 3,
                'code' => 'CPL03-3B',
                'description' => 'Menggunakan alat bantu pemodelan sistem (UML, DFD, ERD) dalam mendokumentasikan kebutuhan sistem.',
            ],
            [
                'learning_outcome_id' => 3,
                'code' => 'CPL03-3C',
                'description' => 'Menerapkan metodologi pengembangan perangkat lunak (Agile, Waterfall, dsb.) secara tepat.',
            ],
            [
                'learning_outcome_id' => 3,
                'code' => 'CPL03-3D',
                'description' => 'Mengevaluasi kualitas hasil pengembangan sistem informasi berdasarkan standar mutu.',
            ],

            // === CPL04 ===
            [
                'learning_outcome_id' => 4,
                'code' => 'CPL04-4A',
                'description' => 'Mengidentifikasi komponen utama dan arsitektur infrastruktur TI organisasi.',
            ],
            [
                'learning_outcome_id' => 4,
                'code' => 'CPL04-4B',
                'description' => 'Menganalisis kebutuhan keamanan jaringan dan layanan berbasis cloud.',
            ],
            [
                'learning_outcome_id' => 4,
                'code' => 'CPL04-4C',
                'description' => 'Menerapkan mekanisme identifikasi, otentikasi, dan otorisasi pada sistem informasi.',
            ],
            [
                'learning_outcome_id' => 4,
                'code' => 'CPL04-4D',
                'description' => 'Mengevaluasi efektivitas kontrol keamanan terhadap ancaman dan risiko siber.',
            ],

            // === CPL05 ===
            [
                'learning_outcome_id' => 5,
                'code' => 'CPL05-5A',
                'description' => 'Menjelaskan prinsip dan standar etika profesi bidang teknologi informasi.',
            ],
            [
                'learning_outcome_id' => 5,
                'code' => 'CPL05-5B',
                'description' => 'Mengidentifikasi potensi pelanggaran etika dalam pengelolaan data dan sistem.',
            ],
            [
                'learning_outcome_id' => 5,
                'code' => 'CPL05-5C',
                'description' => 'Menerapkan kode etik dan prinsip keberlanjutan dalam pengembangan sistem informasi.',
            ],
            [
                'learning_outcome_id' => 5,
                'code' => 'CPL05-5D',
                'description' => 'Mengevaluasi implikasi sosial, hukum, dan etika dari penerapan teknologi informasi.',
            ],

            // === CPL06 ===
            [
                'learning_outcome_id' => 6,
                'code' => 'CPL06-6A',
                'description' => 'Menganalisis kesesuaian strategi sistem informasi dengan visi dan misi organisasi.',
            ],
            [
                'learning_outcome_id' => 6,
                'code' => 'CPL06-6B',
                'description' => 'Merancang rencana strategis pengembangan sistem informasi jangka menengah/panjang.',
            ],
            [
                'learning_outcome_id' => 6,
                'code' => 'CPL06-6C',
                'description' => 'Menerapkan kebijakan dan prosedur operasional dalam pengelolaan sistem informasi.',
            ],
            [
                'learning_outcome_id' => 6,
                'code' => 'CPL06-6D',
                'description' => 'Mengevaluasi efektivitas sistem informasi terhadap pencapaian tujuan strategis organisasi.',
            ],

            // === CPL07 ===
            [
                'learning_outcome_id' => 7,
                'code' => 'CPL07-7A',
                'description' => 'Merancang rencana proyek sistem informasi yang mencakup lingkup, waktu, biaya, dan sumber daya.',
            ],
            [
                'learning_outcome_id' => 7,
                'code' => 'CPL07-7B',
                'description' => 'Menerapkan teknik dan metodologi manajemen proyek (Agile, PMBOK, PRINCE2, dsb.).',
            ],
            [
                'learning_outcome_id' => 7,
                'code' => 'CPL07-7C',
                'description' => 'Mengendalikan pelaksanaan proyek dengan memperhatikan risiko, mutu, dan komunikasi tim.',
            ],
            [
                'learning_outcome_id' => 7,
                'code' => 'CPL07-7D',
                'description' => 'Mengevaluasi hasil dan dampak proyek terhadap peningkatan proses bisnis organisasi.',
            ],

            // === CPL08 ===
            [
                'learning_outcome_id' => 8,
                'code' => 'CPL08-8A',
                'description' => 'Menunjukkan tanggung jawab profesional dan etika dalam setiap aktivitas kerja.',
            ],
            [
                'learning_outcome_id' => 8,
                'code' => 'CPL08-8B',
                'description' => 'Beradaptasi secara efektif dalam lingkungan kerja digital dan multikultural.',
            ],
            [
                'learning_outcome_id' => 8,
                'code' => 'CPL08-8C',
                'description' => 'Menerapkan keterampilan komunikasi lintas budaya dalam konteks kerja tim global.',
            ],
            [
                'learning_outcome_id' => 8,
                'code' => 'CPL08-8D',
                'description' => 'Berpartisipasi aktif dan berkolaborasi secara produktif dalam tim global.',
            ],

            // === CPL09 ===
            [
                'learning_outcome_id' => 9,
                'code' => 'CPL09-9A',
                'description' => 'Mengidentifikasi masalah penelitian yang relevan di bidang sistem informasi dan teknologi bisnis.',
            ],
            [
                'learning_outcome_id' => 9,
                'code' => 'CPL09-9B',
                'description' => 'Menerapkan metode ilmiah untuk mengumpulkan dan menganalisis data riset.',
            ],
            [
                'learning_outcome_id' => 9,
                'code' => 'CPL09-9C',
                'description' => 'Merancang solusi inovatif berbasis hasil riset dan teknologi terkini.',
            ],
            [
                'learning_outcome_id' => 9,
                'code' => 'CPL09-9D',
                'description' => 'Mempresentasikan hasil riset dalam bentuk laporan ilmiah atau publikasi profesional.',
            ],

            // === CPL10 ===
            [
                'learning_outcome_id' => 10,
                'code' => 'CPL10-10A',
                'description' => 'Mengidentifikasi peluang usaha berbasis teknologi informasi di lingkungan masyarakat atau industri.',
            ],
            [
                'learning_outcome_id' => 10,
                'code' => 'CPL10-10B',
                'description' => 'Merancang produk atau solusi sistem informasi yang memiliki nilai tambah ekonomi dan sosial.',
            ],
            [
                'learning_outcome_id' => 10,
                'code' => 'CPL10-10C',
                'description' => 'Menerapkan konsep technopreneurship dalam pengembangan dan pemasaran produk digital.',
            ],
            [
                'learning_outcome_id' => 10,
                'code' => 'CPL10-10D',
                'description' => 'Mengevaluasi keberlanjutan bisnis berbasis teknologi dari aspek etika, ekonomi, dan sosial.',
            ],
        ]);
    }
}
