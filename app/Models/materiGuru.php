<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiGuru extends Model
{
    protected $guarded = [];

    // relasi untuk guru
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function struktur()
    {
        return $this->hasMany(materiStrukture::class, 'materiGuru_id');
    }

    public function rombelmateri()
    {
        return $this->belongsToMany(rombel_mapel_guru::class, 'rombelMateri');
    }
    public function materi_rombel()
    {
        return $this->belongsToMany(rombel_mapel_guru::class, 'materi_rombel');
    }

    public function question()
    {
        return $this->hasMany(questions::class);
    }

    public function nilai()
    {
        return $this->hasMany(nilai::class);
    }
}
