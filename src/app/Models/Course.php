<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_id');
    }

    public function requiredBy()
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'prerequisite_id', 'course_id');
    }

    public function pl()
    {
        return $this->belongsToMany(GraduateProfile::class, 'course_pl', 'course_id', 'pl_id');
    }

    public function cpl()
    {
        return $this->belongsToMany(LearningOutcome::class, 'course_cpl', 'course_id', 'cpl_id');
    }

    public function ik()
    {
        return $this->belongsToMany(LearningOutcomeIndicator::class, 'course_ik', 'course_id', 'ik_id');
    }

    public function cpmk()
    {
        return $this->belongsToMany(CourseLearningOutcome::class, 'course_cpmk', 'course_id', 'cpmk_id');
    }

    public function rps()
    {
        return $this->hasMany(Rps::class);
    }



}
