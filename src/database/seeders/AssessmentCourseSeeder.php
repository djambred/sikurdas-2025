<?php

namespace Database\Seeders;

use App\Models\AssessmentCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssessmentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssessmentCourse::firstOrCreate([
            'name' => 'Ujian Tengah Semester',
            'code' => 'UTS',
        ]);
        AssessmentCourse::firstOrCreate([
            'name' => 'Ujian Akhir Semester',
            'code' => 'UAS',
        ]);
        AssessmentCourse::firstOrCreate([
            'name' => 'Project Akhir',
            'code' => 'PROJECT',
        ]);
        AssessmentCourse::firstOrCreate([
            'name' => 'Kuis',
            'code' => 'KUIS',
        ]);
        AssessmentCourse::firstOrCreate([
            'name' => 'Tugas',
            'code' => 'TUGAS',
        ]);
    }
}
