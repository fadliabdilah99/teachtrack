<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sellMateri extends Model
{
    protected $guarded = [];

    public function materiGuru()
    {
        return $this->belongsTo(materiGuru::class, 'materi_guru_id');
    }
    public function terjual()
    {
        return $this->belongsTo(User::class, 'terjual_id');
    }

    public function pembeli()
    {
        return $this->hasMany(buyMateri::class);
    }
}
