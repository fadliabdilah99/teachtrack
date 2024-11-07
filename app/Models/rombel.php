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
}
