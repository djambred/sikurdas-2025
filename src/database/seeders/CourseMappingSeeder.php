<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLearningOutcome;
use App\Models\GraduateProfile;
use App\Models\LearningOutcome;
use App\Models\LearningOutcomeIndicator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $pls = GraduateProfile::all();
        $cpls = LearningOutcome::all();
        $iks = LearningOutcomeIndicator::all();
        $cpmks = CourseLearningOutcome::all();

        foreach ($courses as $index => $course) {
            // Mapping PL (siklus berulang agar semua PL digunakan)
            $pl = $pls->get($index % $pls->count());
            $course->pl()->syncWithoutDetaching([$pl->id]);

            // Mapping CPL
            $cpl = $cpls->get($index % $cpls->count());
            $course->cpl()->syncWithoutDetaching([$cpl->id]);

            // Mapping IK
            // Ambil semua IK dari CPL yang terkait
            $ikRelated = $iks->where('learning_outcome_id', $cpl->id)->pluck('id')->toArray();
            if (!empty($ikRelated)) {
                $course->ik()->syncWithoutDetaching($ikRelated);
            }

            // Mapping CPMK
            $cpmk = $cpmks->get($index % $cpmks->count());
            $course->cpmk()->syncWithoutDetaching([$cpmk->id]);
        }
    }
}
