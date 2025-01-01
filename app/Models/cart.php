<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }
}
