<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class optionQuestion extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(questions::class, 'question_id');
    }

    public function userMateriGuru()
    {
        return $this->hasMany(user_materi_guru::class, 'option_question_id');
    }

    public function userSelectOption()
    {
        return $this->hasMany(user_select_option::class, 'option_id');
    }


}
