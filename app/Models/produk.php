<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function foto()
    {
        return $this->hasMany(fotoProduk::class);
    }
}
