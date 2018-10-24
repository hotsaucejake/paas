<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// passwordless login
use dam1r89\PasswordlessAuth\UsersRepository;
use dam1r89\PasswordlessAuth\Contracts\UsersProvider;
// roles and permissions
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements UsersProvider
{
    use Notifiable;
    use UsersRepository;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
