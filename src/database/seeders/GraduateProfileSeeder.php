<?php

namespace Database\Seeders;

use App\Models\GraduateProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraduateProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'code' => 'PL01',
                'description' => 'Lulusan memiliki kemampuan untuk menganalisis kebutuhan strategis bisnis, menetapkan metode pemodelan, merancang arsitektur , menganalisis kesenjangan (gap analysis), menyusun roadmap,  serta memfinalisasikan blueprint dan dokumen arsitekturyang selaras dengan tujuan organisasi.',
                'profesi' => 'TIK.ITG0603 ENTERPRISE ARCHITECT',
            ],
            [
                'code' => 'PL02',
                'description' => 'Lulusan memiliki kemampuan untuk melaksanakan keseluruhan proses audit TI secara sistematis, menganalisis risiko dan menyusun rencana audit, mengidentifikasi dan mengevaluasi rancangan serta pelaksanaan kontrol TI, menilai hasil prosedur audit, menyusun laporan hasil audit beserta rekomendasi, serta memverifikasi kelayakan tindak lanjut berdasarkan analisis data yang akurat.',
                'profesi' => 'TIK.ITG0606 IT AUDITOR',
            ],
            [
                'code' => 'PL03',
                'description' => 'Lulusan memiliki kemampuan untuk mengidentifikasi permasalahan bisnis, mengumpulkan dan mengolah data, membangun model analitik, serta mengembangkan dan menyajikan solusi intelijen bisnis untuk mendukung pengambilan keputusan organisasi berbasis data.',
                'profesi' => 'TIK.DSC0605 BUSINESS INTELLIGENCE ANALYST',
            ],
            [
                'code' => 'PL04',
                'description' => 'Lulusan memiliki kemampuan untuk menganalisis dan menerjemahkan kebutuhan bisnis menjadi spesifikasi kebutuhan sistem dan perangkat lunak, merancang solusi teknis  untuk memastikan implementasi sistem informasi yang efisien, efektif, dan selaras dengan tujuan organisasi.',
                'profesi' => 'TIK.DEV0613 SYSTEM ANALYST',
            ],
            [
                'code' => 'PL05',
                'description' => 'Lulusan memiliki kemampuan untuk merencanakan kebutuhan, menganalisis proses bisnis, mengevaluasi dan menentukan solusi ERP, serta mengelola pengujian sistem dan memastikan implementasi sistem ERP yang efektif dan terintegrasi dengan kebutuhan organisasi.',
                'profesi' => 'TIK.DEV0618 ERP OFFICER',
            ],
        ];

        foreach ($profiles as $profile) {
            GraduateProfile::firstOrCreate($profile);
        }
    }
}
