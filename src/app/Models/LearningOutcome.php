<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model LearningOutcome adalah base class untuk CPMK dan Sub-CPMK
 * Kedua model ini punya relasi ke LearningOutcomeIndicator (IK)
 */
class LearningOutcome extends Model
{
    use HasFactory;

    protected $table = 'learning_outcomes';
    protected $guarded = ['id'];

    protected $casts = [
        'type' => 'string', // 'cpmk' atau 'sub_cpmk'
    ];

    /**
     * Relasi ke Indikator Kinerja (IK)
     */
    public function indicators(): HasMany
    {
        return $this->hasMany(LearningOutcomeIndicator::class);
    }

    /**
     * Scope: Ambil hanya CPMK
     */
    public function scopeCpmk($query)
    {
        return $query->where('type', 'cpmk');
    }

    /**
     * Scope: Ambil hanya Sub-CPMK
     */
    public function scopeSubCpmk($query)
    {
        return $query->where('type', 'sub_cpmk');
    }
}
