<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru_mapel extends Model
{
    protected $guarded = [];

    // Relasi ke model Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // Relasi ke model User (guru)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rombel()
    {
        return $this->belongsToMany(Rombel::class, 'rombel_mapel_gurus');
    }

    public function materiGuru()
    {
        return $this->hasMany(materiGuru::class);
    }
}
