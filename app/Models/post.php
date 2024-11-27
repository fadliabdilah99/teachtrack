<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class);
    }

    public function fotoPost()
    {
        return $this->hasMany(fotoPost::class);
    }
}
