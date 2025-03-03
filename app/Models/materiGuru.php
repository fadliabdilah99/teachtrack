<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiGuru extends Model
{
    protected $guarded = [];

    // relasi untuk guru

    public function gurumapel()
    {
        return $this->belongsTo(guru_mapel::class, 'guru_mapel_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function struktur()
    {
        return $this->hasMany(materiStrukture::class, 'materiGuru_id');
    }

    
    public function materi_rombel()
    {
        return $this->belongsToMany(rombel_mapel_guru::class, 'materi_rombels');
    }

    public function question()
    {
        return $this->hasMany(questions::class);
    }

    public function nilai()
    {
        return $this->hasMany(nilai::class);
    }

    public function sell()
    {
        return $this->hasMany(sellMateri::class, 'materi_guru_id');
    }

    public function buy()
    {
        return $this->hasMany(buyMateri::class, 'sell_materi_id');
    }

    public function materi_rombels()
    {
        return $this->hasMany(materi_rombel::class);
    }
}
