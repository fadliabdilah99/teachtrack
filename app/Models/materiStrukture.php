<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiStrukture extends Model
{
    protected $guarded = [];

    public function materiGuru()
    {
        return $this->belongsTo(materiGuru::class);
    }
}
