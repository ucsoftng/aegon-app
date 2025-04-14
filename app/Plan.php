<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = ['name','minimum','image','maximum','total_percent','active','time','dummy_time','percent','end_percent','compound_id','plan_type_id','stop_loss','risk_factor','status','description'];

    public function compound()
    {
        return $this->belongsTo(Compound::class,'compound_id');
    }
    public function plantype()
    {
        return $this->belongsTo(PlanType::class, 'plan_type_id');
    }
}
