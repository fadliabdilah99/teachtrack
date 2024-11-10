<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsToMany(User::class, 'guru_mapels');
    }
}
