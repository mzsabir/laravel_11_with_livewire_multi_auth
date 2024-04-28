<?php

namespace App\Http\Controllers;
use app\Models\Hearing;

abstract class Controller
{
    public function create()
    {
        $cases=Hearing::where('client_id',Auth()->user()->id)->all();
        return view('hearing.create',compact('cases'));
    }
}
