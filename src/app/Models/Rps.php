<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rps extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'weekly_plan' => 'array',
        'assessment' => 'array',
        'references' => 'array',
        'tanggal_penyusunan' => 'date',
        'existing_cpmks' => 'array',
        'existing_sub_cpmks' => 'array',
    ];

    /**
     * Event handler untuk setelah RPS dibuat/diupdate
     */
    protected static function booted()
    {
        static::saved(function (Rps $rps) {
            // Sync CPMK yang dipilih
            if ($rps->existing_cpmks) {
                $rps->cpmks()->sync($rps->existing_cpmks);
            }

            // Sync Sub-CPMK yang dipilih
            if ($rps->existing_sub_cpmks) {
                $rps->subCpmks()->sync($rps->existing_sub_cpmks);
            }
        });
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function cpmks(): BelongsToMany
    {
        return $this->belongsToMany(
            CourseLearningOutcome::class,
            'rps_cpmk',
            'rps_id',
            'course_learning_outcome_id'
        );
    }

    public function subCpmks(): BelongsToMany
    {
        return $this->belongsToMany(
            TopicLearningOutcome::class,
            'rps_sub_cpmk',
            'rps_id',
            'topic_learning_outcome_id'
        );
    }
}
