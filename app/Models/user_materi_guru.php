<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_materi_guru extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi_guru()
    {
        return $this->belongsTo(materiGuru::class);
    }
    public function materistructure()
    {
        return $this->belongsTo(materiStrukture::class);
    }

    public function soal()
    {
        return $this->belongsTo(questions::class);
    }

    public function userSelectOption()
    {
        return $this->hasOne(user_select_option::class, 'option_id');
    }
}
