<?php

namespace Database\Seeders;

use App\Models\CourseLearningOutcome;
use App\Models\TopicLearningOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicLearningOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua CPMK yang ada
        $cpmk1 = CourseLearningOutcome::where('code', 'CPMK1')->first();
        $cpmk2 = CourseLearningOutcome::where('code', 'CPMK2')->first();
        $cpmk3 = CourseLearningOutcome::where('code', 'CPMK3')->first();
        $cpmk4 = CourseLearningOutcome::where('code', 'CPMK4')->first();
        $cpmk5 = CourseLearningOutcome::where('code', 'CPMK5')->first();
        $cpmk6 = CourseLearningOutcome::where('code', 'CPMK6')->first();

        $data = [
            // ==================== CPMK1: FONDASI GLOBAL ====================
            [
                'code' => 'Sub-CPMK1.1',
                'detail' => 'Mampu menjelaskan konsep dasar sistem informasi dan teknologi dalam konteks global dengan terminologi bahasa Inggris yang tepat',
                'course_learning_outcome_id' => $cpmk1->id,
                'order' => 1,
                'complexity_level' => 'basic',
                'assessment_type' => 'knowledge',
                'has_english_component' => true,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK1.2',
                'detail' => 'Mampu mendemonstrasikan logika pemrograman dasar dan menyusun dokumentasi kode dalam bahasa Inggris',
                'course_learning_outcome_id' => $cpmk1->id,
                'order' => 2,
                'complexity_level' => 'basic',
                'assessment_type' => 'skill',
                'has_english_component' => true,
                'has_global_context' => false,
            ],
            [
                'code' => 'Sub-CPMK1.3',
                'detail' => 'Mampu menjelaskan arsitektur sistem komputer dan jaringan dengan referensi standar internasional',
                'course_learning_outcome_id' => $cpmk1->id,
                'order' => 3,
                'complexity_level' => 'basic',
                'assessment_type' => 'knowledge',
                'has_english_component' => false,
                'has_global_context' => true,
            ],

            // ==================== CPMK2: ANALISIS ENTERPRISE ====================
            [
                'code' => 'Sub-CPMK2.1',
                'detail' => 'Mampu menganalisis kebutuhan bisnis organisasi multinasional dan menerjemahkannya menjadi kebutuhan sistem',
                'course_learning_outcome_id' => $cpmk2->id,
                'order' => 1,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK2.2',
                'detail' => 'Mampu memodelkan proses bisnis global menggunakan notasi standar internasional (BPMN, UML)',
                'course_learning_outcome_id' => $cpmk2->id,
                'order' => 2,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'skill',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK2.3',
                'detail' => 'Mampu menyusun dokumen blueprint sistem informasi dalam bahasa Inggris sesuai standar IEEE',
                'course_learning_outcome_id' => $cpmk2->id,
                'order' => 3,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => true,
                'has_global_context' => true,
            ],

            // ==================== CPMK3: DATA STRATEGIS GLOBAL ====================
            [
                'code' => 'Sub-CPMK3.1',
                'detail' => 'Mampu merancang basis data enterprise yang memenuhi standar normalisasi dan performa internasional',
                'course_learning_outcome_id' => $cpmk3->id,
                'order' => 1,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'skill',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK3.2',
                'detail' => 'Mampu melakukan analisis data untuk business intelligence menggunakan teknik data mining dan machine learning',
                'course_learning_outcome_id' => $cpmk3->id,
                'order' => 2,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => false,
            ],
            [
                'code' => 'Sub-CPMK3.3',
                'detail' => 'Mampu menyajikan insights bisnis dalam presentasi berbahasa Inggris kepada manajemen global',
                'course_learning_outcome_id' => $cpmk3->id,
                'order' => 3,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => true,
                'has_global_context' => true,
            ],

            // ==================== CPMK4: IMPLEMENTASI GLOBAL ====================
            [
                'code' => 'Sub-CPMK4.1',
                'detail' => 'Mampu mengimplementasikan kode program dengan best practices dan dokumentasi dalam bahasa Inggris',
                'course_learning_outcome_id' => $cpmk4->id,
                'order' => 1,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'skill',
                'has_english_component' => true,
                'has_global_context' => false,
            ],
            [
                'code' => 'Sub-CPMK4.2',
                'detail' => 'Mampu mengembangkan aplikasi web responsive dengan framework modern dan standar internasional',
                'course_learning_outcome_id' => $cpmk4->id,
                'order' => 2,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'skill',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK4.3',
                'detail' => 'Mampu menerapkan keamanan sistem informasi berdasarkan framework internasional (ISO 27001, NIST)',
                'course_learning_outcome_id' => $cpmk4->id,
                'order' => 3,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],

            // ==================== CPMK5: TATA KELOLA GLOBAL ====================
            [
                'code' => 'Sub-CPMK5.1',
                'detail' => 'Mampu menyusun rencana proyek TI dengan metodologi internasional (Agile, Scrum, Waterfall)',
                'course_learning_outcome_id' => $cpmk5->id,
                'order' => 1,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'skill',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK5.2',
                'detail' => 'Mampu melakukan audit sistem informasi berdasarkan framework global (COBIT, ITIL)',
                'course_learning_outcome_id' => $cpmk5->id,
                'order' => 2,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK5.3',
                'detail' => 'Mampu menyusun laporan audit profesional dalam bahasa Inggris dengan rekomendasi perbaikan',
                'course_learning_outcome_id' => $cpmk5->id,
                'order' => 3,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => true,
                'has_global_context' => true,
            ],

            // ==================== CPMK6: KEPROFESIAN GLOBAL ====================
            [
                'code' => 'Sub-CPMK6.1',
                'detail' => 'Mampu menerapkan etika profesi TI dalam konteks lintas budaya dan regulasi global',
                'course_learning_outcome_id' => $cpmk6->id,
                'order' => 1,
                'complexity_level' => 'intermediate',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK6.2',
                'detail' => 'Mampu berkomunikasi teknis efektif dalam bahasa Inggris melalui presentasi dan diskusi',
                'course_learning_outcome_id' => $cpmk6->id,
                'order' => 2,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => true,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK6.3',
                'detail' => 'Mampu berkolaborasi dalam tim multikultural dengan empati dan pemahaman budaya',
                'course_learning_outcome_id' => $cpmk6->id,
                'order' => 3,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
            [
                'code' => 'Sub-CPMK6.4',
                'detail' => 'Mampu mengembangkan business model canvas untuk startup teknologi dengan visi global',
                'course_learning_outcome_id' => $cpmk6->id,
                'order' => 4,
                'complexity_level' => 'advanced',
                'assessment_type' => 'competence',
                'has_english_component' => false,
                'has_global_context' => true,
            ],
        ];

        foreach ($data as $item) {
            TopicLearningOutcome::firstOrCreate(
                ['code' => $item['code']],
                $item
            );
        }
    }
}
