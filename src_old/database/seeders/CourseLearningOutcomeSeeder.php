<?php

namespace Database\Seeders;

use App\Models\CourseLearningOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseLearningOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseLearningOutcomes = [
            [
                'code' => 'CPMK1',
                'description' => 'Pemahaman Fondasi & Logika Komputasi dalam Konteks Global',
                'detail' => 'Kemampuan menjelaskan konsep dasar, logika pemrograman, dan arsitektur sistem serta mendokumentasikannya dalam bahasa Inggris sesuai standar internasional.',
            ],
            [
                'code' => 'CPMK2',
                'description' => 'Analisis dan Perancangan Model Sistem Enterprise',
                'detail' => 'Kemampuan menganalisis kebutuhan bisnis multinasional, memodelkan proses bisnis global, dan merancang arsitektur sistem informasi (blueprint) dengan dokumentasi berbahasa Inggris.',
            ],
            [
                'code' => 'CPMK3',
                'description' => 'Manajemen dan Analisis Data Strategis untuk Pengambilan Keputusan Global',
                'detail' => 'Kemampuan merancang basis data enterprise, mengelola data besar, melakukan analisis data untuk business intelligence, serta menyajikan insights dalam presentasi berbahasa Inggris.',
            ],
            [
                'code' => 'CPMK4',
                'description' => 'Implementasi & Operasional Infrastruktur TI dengan Standar Internasional',
                'detail' => 'Kemampuan mengimplementasikan kode program, mengelola infrastruktur (jaringan, cloud), menjamin keamanan sistem sesuai standar global, dan berkoordinasi dengan tim internasional.',
            ],
            [
                'code' => 'CPMK5',
                'description' => 'Tata Kelola, Audit, dan Manajemen Proyek SI Bertaraf Multinasional',
                'detail' => 'Kemampuan mengelola proyek TI internasional, melakukan audit sistem informasi berdasarkan framework global, serta menyusun laporan profesional dalam bahasa Inggris.',
            ],
            [
                'code' => 'CPMK6',
                'description' => 'Keprofesian Global, Etika, dan Komunikasi Teknis Internasional',
                'detail' => 'Kemampuan beretika profesional lintas budaya, berkomunikasi teknis efektif dalam bahasa Inggris, berkolaborasi dalam tim multikultural, dan menerapkan technopreneurship dengan perspektif global.',
            ],
        ];

        foreach ($courseLearningOutcomes as $outcome) {
            CourseLearningOutcome::firstOrCreate($outcome);
        }
    }
}
