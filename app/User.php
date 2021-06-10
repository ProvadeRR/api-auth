<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, hasApiTokens;

    const API_FIELDS_REGISTRATION = [
        'name', 'surname', 'email' , 'password'
    ];

    const API_FIELDS_LOGIN = [
      'email', 'password'
    ];

    const EMAIL = 'email';

    const REMEMBER_ME = 'remember_me';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','surname', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeEmail($query,$email){
        return $query->where('email' , $email);
    }
}
