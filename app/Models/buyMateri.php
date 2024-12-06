<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buyMateri extends Model
{
    protected $guarded = [];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materiGuru()
    {
        return $this->belongsTo(materiGuru::class, 'materi_guru_id');
    }

    public function sell(){
        return $this->belongsTo(sellMateri::class);
    }
    
}
