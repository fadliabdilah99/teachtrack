<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rombel_mapel_guru extends Model
{
    protected $guarded = [];

    public function guruMapel(){
        return $this->belongsTo(guru_mapel::class);
    }
}
