<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppointmentController extends Controller
{
    public function appointment($id=0)
    {
       $uid = Auth::id();
       if($id==0)
          $lawyer="";
       else
          $lawyer=User::where('id',$id)->get()->first();
       //dd($lawyer);
       return view('appointment',compact('lawyer','uid'));
    }
}
