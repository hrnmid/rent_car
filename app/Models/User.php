<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'unique_id',
        'email',
        'password',
        'name_prefix',
        'first_name',
        'last_name',
        'phone',
        'address',
        'kecamatan',
        'kelurahan',
        'postal_code',
        'role',
        // 'verification_token',
        'is_active',
        'profile_path',
        'is_verified',
        // 'is_deleted',
        'verif_path',
        'kwc_required'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
         */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
