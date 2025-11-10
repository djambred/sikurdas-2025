<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningOutcomeIndicator extends Model
{
    protected $guarded = ['id'];

    public function learningOutcome()
    {
        return $this->belongsTo(LearningOutcome::class);
    }
}
