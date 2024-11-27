<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fotoPost extends Model
{
    protected $guarded = [];
    

    public function post()
    {
        return $this->belongsTo(post::class);
    }
}
