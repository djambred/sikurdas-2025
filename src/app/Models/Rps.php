<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rps extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'weekly_plan' => 'array',
        'assessment' => 'array',
        'references' => 'array',
        'tanggal_penyusunan' => 'date',
    ];

    /**
     * Boot the model.
     * Handler untuk relasi Many-to-Many yang dikelola melalui CheckboxList di Filament.
     */
    protected static function booted()
    {
        static::saved(function (Rps $rps) {
            // Relasi lectures sudah ditangani otomatis oleh Filament
            // melalui relationship() di form CheckboxList
        });
    }

    // ===== RELASI BELONGS-TO =====

    /**
     * Relasi ke Program Studi
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Relasi ke Mata Kuliah
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi ke Dosen Penyusun RPS
     */
    public function penyusun(): BelongsTo
    {
        return $this->belongsTo(Lecture::class, 'penyusun_id');
    }

    /**
     * Relasi ke Koordinator RPS
     */
    public function koordinator(): BelongsTo
    {
        return $this->belongsTo(Lecture::class, 'koordinator_rps_id');
    }

    /**
     * Relasi ke Ketua Program Studi
     */
    public function ketuaProdi(): BelongsTo
    {
        return $this->belongsTo(Lecture::class, 'ketua_prodi_id');
    }

    // ===== RELASI BELONGS-TO-MANY =====

    /**
     * Relasi ke Dosen Pengampu (Many-to-Many)
     * Tabel pivot: rps_lecture
     */
    public function lectures(): BelongsToMany
    {
        return $this->belongsToMany(
            Lecture::class,
            'rps_lecture',
            'rps_id',
            'lecture_id'
        );
    }

    /**
     * Relasi ke Capaian Pembelajaran Mata Kuliah (Many-to-Many)
     * Tabel pivot: rps_cpmk
     */
    public function cpmks(): BelongsToMany
    {
        return $this->belongsToMany(
            CourseLearningOutcome::class,
            'rps_cpmk',
            'rps_id',
            'course_learning_outcome_id'
        );
    }

    /**
     * Relasi ke Sub-CPMK (Many-to-Many)
     * Tabel pivot: rps_sub_cpmk
     */
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
