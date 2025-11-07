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
                'body_of_knowledge' => 'Foundations of Information Systems (Konsep Dasar SI)',
                'main_reference' => 'IS2020 A3.1',
            ],
            [
                'code' => 'BK02',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Information Management (incl. Database)',
                'main_reference' => 'IS2020 A3.2.1 - SKKNI Data Management System',
            ],
            [
                'code' => 'BK03',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Business Analytics (Data Mining, AI, BI)',
                'main_reference' => 'IS2020 A3.2.2',
            ],
            [
                'code' => 'BK04',
                'competency_realm' => 'Data',
                'body_of_knowledge' => 'Data / Information Visualization',
                'main_reference' => 'IS2020 A3.2.3',
            ],
            [
                'code' => 'BK05',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'IT Infrastructure (incl. Networking, Cloud)',
                'main_reference' => 'IS2020 A3.3.1 - Pengetahuan Wajib INFOKOM',
            ],
            [
                'code' => 'BK06',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'Secure Computing / Security Technology and Implementation',
                'main_reference' => 'IS2020 A3.3.2 - Pengetahuan Wajib INFOKOM',
            ],
            [
                'code' => 'BK07',
                'competency_realm' => 'Technology',
                'body_of_knowledge' => 'Emerging Technologies (IoT, Blockchain, dll.)',
                'main_reference' => 'IS2020 A3.3.3',
            ],
            [
                'code' => 'BK08',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Systems Analysis & Design',
                'main_reference' => 'IS2020 A3.4.1 - CC 2020',
            ],
            [
                'code' => 'BK09',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Application Development / Programming',
                'main_reference' => 'IS2020 A3.4.2 - SKKNI Programming',
            ],
            [
                'code' => 'BK10',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'Object-Oriented Paradigm, Web, Mobile Programming',
                'main_reference' => 'IS2020 A3.4.3, A3.4.4, A3.4.5 - Pengetahuan Wajib INFOKOM',
            ],
            [
                'code' => 'BK11',
                'competency_realm' => 'Development',
                'body_of_knowledge' => 'User Interface Design / User Experience Design',
                'main_reference' => 'IS2020 A3.4.6 - Pengetahuan Wajib INFOKOM',
            ],
            [
                'code' => 'BK12',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Ethics, use and implications for society (Etika SI)',
                'main_reference' => 'IS2020 A3.5.1 - CC 2020',
            ],
            [
                'code' => 'BK13',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'IS Management & Strategy',
                'main_reference' => 'IS2020 A3.5.2 - CC 2020',
            ],
            [
                'code' => 'BK14',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Digital Innovation / Emerging Technologies',
                'main_reference' => 'IS2020 A3.5.3 - VMPS',
            ],
            [
                'code' => 'BK15',
                'competency_realm' => 'Organizational Domain',
                'body_of_knowledge' => 'Business Process Management / Enterprise Architecture',
                'main_reference' => 'IS2020 A3.5.4 - CC 2020',
            ],
            [
                'code' => 'BK16',
                'competency_realm' => 'Integration',
                'body_of_knowledge' => 'IS Project Management',
                'main_reference' => 'IS2020 A3.6.1 - CC 2020 - SKKNI Manaj. Proyek TI',
            ],
            [
                'code' => 'BK17',
                'competency_realm' => 'Integration',
                'body_of_knowledge' => 'IS Practicum / Internship',
                'main_reference' => 'IS2020 A3.6.2 - VMPS',
            ],
        ];

        foreach ($references as $reference) {
            Reference::firstOrCreate($reference);
        }
    }
}
