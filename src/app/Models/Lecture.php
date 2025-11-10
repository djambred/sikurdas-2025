<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $guarded = ['id'];

    public function rps()
    {
        return $this->belongsToMany(Rps::class, 'rps_lecture');
    }
}
