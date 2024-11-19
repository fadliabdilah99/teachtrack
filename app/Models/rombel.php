<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rombel extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function mapelGuru()
    {
        return $this->belongsToMany(guru_mapel::class, 'rombel_mapel_gurus');
    }

    public function jadwal(){
        return $this->hasMany(rombel_mapel_guru::class);
    }

    public function duskusi(){
        return $this->belongsTo(diskusi::class);
    }
}
