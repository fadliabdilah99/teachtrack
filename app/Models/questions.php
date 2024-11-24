<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    protected $guarded = [];

    public function materiGuru()
    {
        return $this->belongsTo(materiGuru::class);
    }

    public function options()
    {
        return $this->hasMany(optionQuestion::class, 'question_id');
    }

    public function userMateri(){
        return $this->hasOne(user_materi_guru::class, 'question_id');
    }

    public function userSelectOption()
    {
        return $this->hasMany(user_select_option::class, 'option_id');
    }
}
