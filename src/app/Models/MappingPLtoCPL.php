<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingPLtoCPL extends Model
{
    protected $guarded = ['id'];

    public function graduateProfile()
    {
        return $this->belongsTo(GraduateProfile::class);
    }
    public function learningOutcome()
    {
        return $this->belongsTo(LearningOutcome::class);
    }
}
