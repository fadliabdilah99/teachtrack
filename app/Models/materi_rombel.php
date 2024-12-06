<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materi_rombel extends Model
{
    protected $guarded = [];

    public function materi(){
        return $this->belongsTo(materiGuru::class, 'materi_guru_id');
    }
}
