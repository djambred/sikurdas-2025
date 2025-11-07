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
                'description' => 'Pemahaman Fondasi & Logika Komputasi',
                'detail' => 'Kemampuan menjelaskan konsep dasar, logika pemrograman, dan arsitektur sistem.',
            ],
            [
                'code' => 'CPMK2',
                'description' => 'Analisis dan Perancangan Model Sistem',
                'detail' => 'Kemampuan menganalisis kebutuhan, memodelkan proses bisnis, dan merancang arsitektur sistem informasi (blueprint).',
            ],
            [
                'code' => 'CPMK3',
                'description' => 'Manajemen dan Analisis Data Strategis',
                'detail' => 'Kemampuan merancang basis data, mengelola data besar, dan melakukan analisis data untuk dukungan keputusan (BI/DM).',
            ],
            [
                'code' => 'CPMK4',
                'description' => 'Implementasi & Operasional Infrastruktur TI',
                'detail' => 'Kemampuan mengimplementasikan kode program, mengelola infrastruktur (jaringan, cloud), dan menjamin keamanan sistem.',
            ],
            [
                'code' => 'CPMK5',
                'description' => 'Tata Kelola, Audit, dan Manajemen Proyek SI',
                'detail' => 'Kemampuan mengelola proyek, melakukan tata kelola (audit, kendali), dan membuat keputusan strategis terkait SI.',
            ],
            [
                'code' => 'CPMK6',
                'description' => 'Keprofesian, Etika, dan Wirausaha Teknologi',
                'detail' => 'Kemampuan beretika, berkomunikasi, berkolaborasi, dan menerapkan konsep wirausaha (technopreneurship) dalam solusi teknologi.',
            ],
        ];

        foreach ($courseLearningOutcomes as $outcome) {
            CourseLearningOutcome::firstOrCreate($outcome);
        }
    }
}
