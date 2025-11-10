<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\EducationLevel;
use App\Models\Faculty;
use App\Models\LearningForm;
use App\Models\LearningOutcome;
use App\Models\LearningOutcomeIndicator;
use App\Models\Lecture;
use App\Models\Reference;
use App\Models\Term;
use App\Models\TopicLearningOutcome;
use App\Models\University;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create()
        $this->call([
            UniversitySeeder::class,
            FacultySeeder::class,
            MajorSeeder::class,
            GraduateProfileSeeder::class,
            LearningOutcomeSeeder::class,
            ReferenceSeeder::class,
            CourseLearningOutcomeSeeder::class,
            TopicLearningOutcomeSeeder::class,
            CategorySeeder::class,
            TermSeeder::class,
            AssessmentCourseSeeder::class,
            EducationLevelSeeder::class,
            LearningFormSeeder::class,
            TermSeeder::class,
            ScienceClusterSeeder::class,
            LearningMethodSeeder::class,
            LectureSeeder::class,
            CourseSeeder::class,
            LearningOutcomeIndicatorSeeder::class,
            CourseMappingSeeder::class,
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole('super_admin');
    }
}
