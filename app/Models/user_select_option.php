<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_select_option extends Model
{
    protected $guarded = [];

    public function userMateri()
    {
        return $this->belongsTo(user_materi_guru::class, 'user_materi_guru_id');
    }

    // Relasi ke tabel questions
    public function question()
    {
        return $this->belongsTo(questions::class, 'question_id');
    }

    // Relasi ke tabel option_questions
    public function option()
    {
        return $this->belongsTo(optionQuestion::class, 'option_id');
    }
}
