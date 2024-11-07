<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $guarded = [];

    public function rombel()
    {
        return $this->hasMany(rombel::class);
    }
}
