<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $references = [
            [
                'code' => 'BK01',
                'competency_realm' => 'Foundations',
                'body_of_knowledge' => 'Foundations of Information Systems dengan Perspektif Global',
                'main_reference' => 'IS2020 A3.1 - IABEE, ABET - Standar Internasional',
            ],
            [
                'code' => 'BK02',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Information Management untuk Enterprise Global',
                'main_reference' => 'IS2020 A3.2.1 - SKKNI Data Management System - Standar Multinasional',
            ],
            [
                'code' => 'BK03',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Business Analytics untuk Pengambilan Keputusan Global',
                'main_reference' => 'IS2020 A3.2.2 - International Business Intelligence Standards',
            ],
            [
                'code' => 'BK04',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Information Visualization dengan Presentasi Multibahasa',
                'main_reference' => 'IS2020 A3.2.3 - Global Data Visualization Standards',
            ],
            [
                'code' => 'BK05',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'IT Infrastructure dengan Standar Keamanan Internasional',
                'main_reference' => 'IS2020 A3.3.1 - Pengetahuan Wajib INFOKOM - ISO 27001',
            ],
            [
                'code' => 'BK06',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'Secure Computing / Cybersecurity untuk Lingkungan Global',
                'main_reference' => 'IS2020 A3.3.2 - Pengetahuan Wajib INFOKOM - NIST Framework',
            ],
            [
                'code' => 'BK07',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'Emerging Technologies dengan Implementasi Global',
                'main_reference' => 'IS2020 A3.3.3 - International Tech Standards',
            ],
            [
                'code' => 'BK08',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Systems Analysis & Design dengan Dokumentasi Bahasa Inggris',
                'main_reference' => 'IS2020 A3.4.1 - CC 2020 - IEEE Standards',
            ],
            [
                'code' => 'BK09',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Application Development dengan Best Practices Internasional',
                'main_reference' => 'IS2020 A3.4.2 - SKKNI Programming - Global Coding Standards',
            ],
            [
                'code' => 'BK10',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Enterprise Programming (Web, Mobile, Cloud) untuk Pasar Global',
                'main_reference' => 'IS2020 A3.4.3, A3.4.4, A3.4.5 - Pengetahuan Wajib INFOKOM - International Market Needs',
            ],
            [
                'code' => 'BK11',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Global User Interface / User Experience Design',
                'main_reference' => 'IS2020 A3.4.6 - Pengetahuan Wajib INFOKOM - International UX Standards',
            ],
            [
                'code' => 'BK12',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Etika Profesi TI dalam Konteks Global dan Lintas Budaya',
                'main_reference' => 'IS2020 A3.5.1 - CC 2020 - International Professional Ethics',
            ],
            [
                'code' => 'BK13',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'IS Management & Strategy untuk Organisasi Multinasional',
                'main_reference' => 'IS2020 A3.5.2 - CC 2020 - Global IT Governance',
            ],
            [
                'code' => 'BK14',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Digital Innovation & Technopreneurship dengan Visi Global',
                'main_reference' => 'IS2020 A3.5.3 - VMPS - International Entrepreneurship',
            ],
            [
                'code' => 'BK15',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Enterprise Architecture & Business Process untuk Perusahaan Global',
                'main_reference' => 'IS2020 A3.5.4 - CC 2020 - TOGAF, International BPM',
            ],
            [
                'code' => 'BK16',
                'competency_realm' => 'Integration',
                'body_of_knowledge' => 'IS Project Management dengan Koordinasi Tim Multinasional',
                'main_reference' => 'IS2020 A3.6.1 - CC 2020 - SKKNI Manaj. Proyek TI - PMI Global Standards',
            ],
            [
                'code' => 'BK17',
                'competency_realm' => 'Integration',
                'body_of_knowledge' => 'IS Practicum / Internship dengan Pengalaman Lingkungan Global',
                'main_reference' => 'IS2020 A3.6.2 - VMPS - International Workplace Standards',
            ],
            [
                'code' => 'BK18',
                'competency_realm' => 'Professional Competence',
                'body_of_knowledge' => 'Global Communication & Cross-cultural Professional Practice',
                'main_reference' => 'IS2020 Individual Foundational Competencies - International Communication Standards - VMPS',
            ],
            [
                'code' => 'BK19',
                'competency_realm' => 'Professional Competence',
                'body_of_knowledge' => 'Technical English & International Business Communication',
                'main_reference' => 'VMPS - International Business Communication Standards - CEFR/TOEFL Standards',
            ],
        ];

        foreach ($references as $reference) {
            Reference::firstOrCreate($reference);
        }
    }
}
