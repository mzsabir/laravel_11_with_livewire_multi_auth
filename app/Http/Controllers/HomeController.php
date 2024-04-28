<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Policecase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
   function home()
   {
        $categories=['Criminal Lawyer','Cooperate Lawyer'];
        return view('welcome',compact('categories'));
   }  
   public function appointment($id=0)
   {
      $uid = Auth::id();
      //dd($id);
      if($id==0)
         $lawyer="";
      else
         $lawyer=User::where('id',$id)->get()->first();
      //dd($lawyer);
      return view('appointment',compact('lawyer','uid'),);
   }

   public function book_appointment(Request $request)
   {

      //dd($request);
      $request->validate([
         'name' => 'required|max:32',
         'subject' => 'required',
         'message' => 'required|string|required|max:255'
     ]);
     $msg = new Message();
     $msg->time = NULL;
     $msg->subject = $request->input('subject');
     //$msg->email = $request->input('email');
     $msg->message = $request->input('message');
     $msg->client_id = $request->input('client_id');
     $msg->lawyer_id = $request->input('lawyer_id');
     
     $msg->save();

     // Additional logic or redirection after successful data storage

     return redirect()->back()->with('success', 'Appoitment set successfully!');
   }
   public function close_case($id)
   {
      $case=Policecase::where('id',$id)->first();
      //dd($case);
      $case->status='completed';
      $case->save();
      return redirect()->back()->with('success', 'Congrdulation! Case is closed successfully!');
   }

   public function rate_case(Request $request)
   {
      $case=Policecase::where('id',$request->input('cid'))->first();
      //dd($case);
      $case->rating=$request->input('cid');
      $case->comments =$request->input('comment');
      $case->save();
     
      return redirect('dashboard')->with('success', 'Congrdulation! Case is closed successfully!');
   }

   public function lawyer_dashboard()
   {
      $cases=Policecase::where('lawyer_id',Auth()->user()->id)->get();
      $pending=Policecase::where('lawyer_id',Auth()->user()->id)->where('status','pending')->count();
      //dd($pending);
      return view('lawyer',compact('pending','cases'));
   }

   public function client_dashboard()
   {
      
      $cases=Policecase::where('client_id',Auth()->user()->id)->get();
      $cases_progress=Policecase::where('client_id',Auth()->user()->id)->where('status','in progress')->get();
      $count=[
         'messages_total'=>Message::where('client_id',Auth()->user()->id)->count(),
         'messages_pending'=>Message::where('client_id',Auth()->user()->id)->where('time',NULL)->count(),
         'cases_in_progress'=>Policecase::where('client_id',Auth()->user())->where('status','completed')->count(),
      ];
      //dd($count);
      //$pending=Policecase::where('lawyer_id',Auth()->user()->id)->where('status','pending')->count();
      return view('client',compact('cases','cases_progress','count'));
   }

   public function admin_dashboard()
   {      
      return view('admin');
   }
}
