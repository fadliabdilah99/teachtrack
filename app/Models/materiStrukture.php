<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiStrukture extends Model
{
    protected $guarded = [];

    public function materiGuru()
    {
        return $this->belongsTo(materiGuru::class, 'materiGuru_id');
    }

    public function siswa()
    {
        return $this->belongsToMany(User::class, 'user_materi_guru');
    }


    public function userMateriGuru()
    {
        return $this->hasOne(user_materi_guru::class, 'materiStrukture_id');
    }

    public function diskusi()
    {
        return $this->hasMany(diskusi::class, 'materiStrukture_id');
    }
}
