<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materiGuru extends Model
{
    protected $guarded = [];

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
}
