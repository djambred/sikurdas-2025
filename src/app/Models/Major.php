<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Major extends Model
{
    protected $guarded = ['id'];

    public function faculty() :BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}
