<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    protected $fillable = ['user_id','balance'];
    protected $table = 'user_referral';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
