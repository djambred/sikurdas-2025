<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicLearningOutcome extends Model
{
    protected $guarded = ['id'];

    public function courseLearningOutcome(): BelongsTo
    {
        return $this->belongsTo(CourseLearningOutcome::class);
    }

    /**
     * Scope untuk filtering berdasarkan complexity level
     */
    public function scopeByComplexity($query, $level)
    {
        return $query->where('complexity_level', $level);
    }

    /**
     * Scope untuk Sub-CPMK dengan komponen English
     */
    public function scopeWithEnglishComponent($query)
    {
        return $query->where('has_english_component', true);
    }

    /**
     * Scope untuk Sub-CPMK dengan konteks global
     */
    public function scopeWithGlobalContext($query)
    {
        return $query->where('has_global_context', true);
    }

    /**
     * Scope untuk urutan tertentu
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('course_learning_outcome_id')
                    ->orderBy('order');
    }
}
