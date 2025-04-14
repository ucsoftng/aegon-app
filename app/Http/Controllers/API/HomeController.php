<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Plan;
use DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlans()
    {
        $data['plans'] = Plan::wherestatus(1)->with('compound')->with('plantype')->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }

}
