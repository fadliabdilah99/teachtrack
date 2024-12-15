<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Absensi extends Model
{
    // Nama table di dalam database
    protected $table = 'absens';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'foto',
    ];


    public function getFotoUrlAttribute()
    {
        return Storage::url($this->foto); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
