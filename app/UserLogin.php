<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $fillable = [
        'user_id','location','user_ip','details'];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
