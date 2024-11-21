<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class optionQuestion extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(questions::class);
    }


}
