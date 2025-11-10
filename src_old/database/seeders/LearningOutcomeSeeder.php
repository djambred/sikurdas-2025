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
            // Mendukung PL01: Enterprise Architect
            [
                'code' => 'CPL01',
                'description' => 'Mampu menganalisis kebutuhan strategis bisnis kompleks dan merancang arsitektur enterprise yang selaras dengan tujuan organisasi, serta menyusun dokumentasi teknis dalam bahasa Inggris sesuai standar internasional.',
                'detail' => 'IS2020 A3.1 Foundations Competency Realm - SKKNI Area Fungsi Information System and Technology Development - IABEE, ABET - Mendukung PL01 Enterprise Architect',
            ],
            // Mendukung PL01 & PL04
            [
                'code' => 'CPL02',
                'description' => 'Mampu merancang dan mengelola sistem manajemen basis data enterprise, melakukan analisis data strategis, serta menyajikan insights bisnis dalam presentasi berbahasa Inggris untuk pengambilan keputusan multinasional.',
                'detail' => 'IS2020 A3.2.1 Data/Information Management - SKKNI Area Fungsi Data Management System - Mendukung PL01 & PL03',
            ],
            // Mendukung PL04: System Analyst
            [
                'code' => 'CPL03',
                'description' => 'Mampu menggunakan metodologi pengembangan sistem dan alat pemodelan untuk menganalisis kebutuhan pengguna global, serta menerjemahkan kebutuhan bisnis menjadi spesifikasi teknis dengan dokumentasi berbahasa Inggris.',
                'detail' => 'IS2020 A3.4.1 System Analysis and Design, A3.4.2 Application Development and Programming - SKKNI Area Fungsi Programming and Software Development - Mendukung PL04',
            ],
            // Mendukung PL01 & PL04
            [
                'code' => 'CPL04',
                'description' => 'Mampu menganalisis dan mengimplementasikan infrastruktur TI, arsitektur jaringan, serta menerapkan keamanan sistem sesuai standar internasional dengan kemampuan berkoordinasi dalam bahasa Inggris.',
                'detail' => 'IS2020 A3.3 Technology Competency Realm (Mencakup IT Infrastructure, Network, and Secure Computing) - Mendukung PL01 & PL04',
            ],
            // Mendukung PL02: IT Auditor
            [
                'code' => 'CPL05',
                'description' => 'Mampu menerapkan kode etik profesi TI secara global, melaksanakan audit sistem informasi berdasarkan framework internasional, serta menyusun laporan audit profesional dalam bahasa Inggris.',
                'detail' => 'IS2020 A3.5.1 IS Ethics, Sustainability, User and Implication - Mendukung PL02',
            ],
            // Mendukung PL01 & PL05
            [
                'code' => 'CPL06',
                'description' => 'Mampu merencanakan dan mengelola strategi sistem informasi organisasi untuk mencapai tujuan bisnis jangka pendek dan panjang, termasuk dalam lingkungan kerja multinasional dengan komunikasi efektif.',
                'detail' => 'IS2020 A3.5.2 IS Management and Strategy - Mendukung PL01 & PL05',
            ],
            // Mendukung PL02 & PL05
            [
                'code' => 'CPL07',
                'description' => 'Mampu menerapkan metodologi manajemen proyek sistem informasi terintegrasi, mengelola proyek TI bertaraf internasional, serta berkoordinasi dengan stakeholder global dalam bahasa Inggris.',
                'detail' => 'IS2020 A3.6.1 IS Project Management - SKKNI Manajemen Proyek TI - Mendukung PL02 & PL05',
            ],
            // Mendukung SEMUA PL (Core Global Competence)
            [
                'code' => 'CPL08',
                'description' => 'Mampu beradaptasi dalam lingkungan kerja industri digital internasional, berkomunikasi teknis efektif dalam bahasa Inggris, berkolaborasi dalam tim multikultural, serta menerapkan etika profesional global.',
                'detail' => 'VMPS (Visi, Misi, Program Studi) - IS2020 Individual Foundational Competencies (Mencakup Collaboration, Ethical Analysis, Intercultural Competency) - Mendukung SEMUA PL',
            ],
            // Mendukung PL03: Business Intelligence Analyst
            [
                'code' => 'CPL09',
                'description' => 'Mampu menganalisis dan merumuskan solusi inovatif berbasis riset dalam bidang sistem informasi, mengembangkan model business intelligence, serta menyajikan temuan analitik untuk keputusan strategis global.',
                'detail' => 'VMPS - IS2020 A3.5.3 Emerging Technologies (Riset & Inovasi) - Mendukung PL03',
            ],
            // Mendukung PL05: ERP Officer & Entrepreneurship
            [
                'code' => 'CPL10',
                'description' => 'Mampu merancang dan mengimplementasikan solusi enterprise systems (ERP), mengelola proses integrasi sistem, serta mengembangkan model technopreneurship dengan perspektif bisnis global.',
                'detail' => 'VMPS - IS2020 A3.6.2 IS Practicum/Internship (Aspek aplikasi & entrepreneurship) - Mendukung PL05',
            ],
        ];

        foreach ($learningOutcomes as $outcome) {
            LearningOutcome::firstOrCreate($outcome);
        }
    }
}
