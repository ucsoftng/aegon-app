<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompounding extends Model
{
    protected $fillable = ['user_id', 'active'];
    protected $table = 'user_compounding';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
