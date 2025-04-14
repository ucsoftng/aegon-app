<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','image','password','phone','address','country','zip','verifyToken','otp_code','amount','under_reference','reference','status','block_status','two_fa',
        'google2fa_secret','two_factor_recovery_codes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret',
    ];

    public function letters()
    {
        return $this->belongsToMany('App\Letter');
    }


}
