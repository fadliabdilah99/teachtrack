<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class diskusi extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rombel()
    {
        return $this->belongsTo(rombel::class);
    }

    public function materi()
    {
        return $this->belongsTo(materiStrukture::class, 'materiStrukture_id');
    }

    public function replies()
    {
        return $this->hasMany(diskusi::class, 'parent');
    }


    public function parent()
    {
        return $this->belongsTo(diskusi::class, 'parent_id');
    }
}
