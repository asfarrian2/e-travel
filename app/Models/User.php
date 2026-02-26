<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'id_pelaksana',
        'nickname',
        'role',
        'id_tahun',
        'jdwl_tahun',
        'profile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const ROLE_SUPERADMIN = 'admin';
    const ROLE_ADMIN = 'kpa';
    const ROLE_USER = 'pptk';

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

     public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pelaksana::class, 'id_pelaksana', 'id_pelaksana');
    }

    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }

}
