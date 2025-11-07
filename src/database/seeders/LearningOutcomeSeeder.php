<?php

namespace Database\Seeders;

use App\Models\LearningOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $learningOutcomes = [
            [
                'code' => 'CPL01',
                'description' => 'Mampu memahami, menganalisis permasalahan computing yang kompleks, dan menilai konsep dasar serta peran sistem informasi dalam mengelola data dan memberikan rekomendasi pengambilan keputusan pada sistem organisasi.',
                'detail' => 'IS2020 A3.1 Foundations Competency Realm - SKKNI Area Fungsi Information System and Technology Development - IABEE, ABET',
            ],
            [
                'code' => 'CPL02',
                'description' => 'Mampu memahami, merancang, menggunakan sistem manajemen basis data, serta mengolah dan menganalisis data dengan peralatan dan metode pengolahan data.',
                'detail' => 'IS2020 A3.2.1 Data/Information Management - SKKNI Area Fungsi Data Management System',
            ],
            [
                'code' => 'CPL03',
                'description' => 'Mampu memahami dan menggunakan berbagai metodologi pengembangan sistem beserta alat pemodelan sistem serta menganalisis kebutuhan pengguna dalam membangun sistem informasi yang berkualitas untuk mencapai tujuan organisasi.',
                'detail' => 'IS2020 A3.4.1 System Analysis and Design, A3.4.2 Application Development and Programming - SKKNI Area Fungsi Programming and Software Development',
            ],
            [
                'code' => 'CPL04',
                'description' => 'Mampu menganalisis infrastruktur SI, arsitektur jaringan, layanan fisik dan cloud, konsep identifikasi, otentikasi, otorisasi akses dalam konteks melindungi orang dan perangkat.',
                'detail' => 'IS2020 A3.3 Technology Competency Realm (Mencakup IT Infrastructure, Network, and Secure Computing)',
            ],
            [
                'code' => 'CPL05',
                'description' => 'Mampu memahami dan menerapkan kode etik organisasi dalam penggunaan informasi maupun data pada perancangan dan implementasi suatu sistem.',
                'detail' => 'IS2020 A3.5.1 IS Ethics, Sustainability, User and Implication',
            ],
            [
                'code' => 'CPL06',
                'description' => 'Memiliki kemampuan merencanakan, menerapkan, memelihara serta meningkatkan sistem informasi organisasi untuk mencapai tujuan dan sasaran organisasi yang strategis baik jangka pendek maupun jangka panjang.',
                'detail' => 'IS2020 A3.5.2 IS Management and Strategy',
            ],
            [
                'code' => 'CPL07',
                'description' => 'Mampu memahami, mengidentifikasi dan menerapkan konsep, teknik dan metodologi manajemen proyek sistem informasi terintegrasi untuk peningkatan proses bisnis organisasi.',
                'detail' => 'IS2020 A3.6.1 IS Project Management - SKKNI Manajemen Proyek TI',
            ],
            [
                'code' => 'CPL08',
                'description' => 'Mampu menunjukkan sikap profesionalisme dan etika, dengan beradaptasi dalam lingkungan kerja industri digital internasional, dengan memanfaatkan kemampuan komunikasi lintas budaya secara bertanggung jawab dalam bentuk visi EMASKU.',
                'detail' => 'VMPS (Visi, Misi, Program Studi) - IS2020 Individual Foundational Competencies (Mencakup Collaboration, Ethical Analysis, Intercultural Competency)',
            ],
            [
                'code' => 'CPL09',
                'description' => 'Mampu mengidentifikasi, menganalisis, dan merumuskan solusi inovatif berbasis riset dalam bidang sistem informasi, untuk berkontribusi pada kemajuan ilmu pengetahuan dan integrasi bisnis.',
                'detail' => 'VMPS - IS2020 A3.5.3 Emerging Technologies (Riset & Inovasi)',
            ],
            [
                'code' => 'CPL10',
                'description' => 'Mampu merancang dan mengimplementasikan solusi sistem informasi yang berjiwa wirausaha (technopreneurship) secara mandiri dan berkelanjutan, sebagai wujud kontribusi nyata pada kebutuhan masyarakat atau industri digital.',
                'detail' => 'VMPS - IS2020 A3.6.2 IS Practicum/Internship (Aspek aplikasi & entrepreneurship)',
            ],
        ];

        foreach ($learningOutcomes as $outcome) {
            LearningOutcome::firstOrCreate($outcome);
        }
    }
}
