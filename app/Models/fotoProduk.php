<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fotoProduk extends Model
{
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
}
