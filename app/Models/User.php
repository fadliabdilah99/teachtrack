<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kelas',
        'role',
        'rombel_id',
        'NoUnik',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rombel()
    {
        return $this->belongsTo(rombel::class);
    }



    // Relasi untuk mendapatkan murid (siswa) dari orang tua
    public function siswa()
    {
        return $this->belongsTo(User::class, 'NoUnik', 'id')
            ->whereIn('role', ['siswa', 'KM', 'WAKM', 'bendahara']);
    }

    // Relasi untuk mendapatkan orang tua dari siswa
    public function orangTua()
    {
        return $this->hasMany(User::class, 'NoUnik', 'id')
            ->where('role', 'ortu');
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapels');
    }


    public function guruMapel()
    {
        return $this->hasMany(guru_mapel::class);
    }

    // relasi untuk guru
    public function materiGuru()
    {
        return $this->hasMany(materiGuru::class);
    }

    public function pelajaran()
    {
        return $this->belongsToMany(materiStrukture::class, 'user_materi_guru');
    }

    public function duskusi()
    {
        return $this->belongsTo(diskusi::class);
    }

    public function nilai()
    {
        return $this->hasMany(nilai::class);
    }

    public function post()
    {
        return $this->hasMany(post::class);
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function like()
    {
        return $this->hasMany(like::class);
    }

    public function buyMateri()
    {
        return $this->hasMany(buyMateri::class);
    }
}
