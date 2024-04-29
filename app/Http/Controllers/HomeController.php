<?php

namespace App\Http\Controllers;

use App\Models\Hearing;
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

     return redirect()->back()->with('success', 'Case has been accepted by Lawyer successfully!');
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
   public function dashboard(){
      $role=Auth::user()->role;
      switch($role){
         case "admin":
             $this->admin_dashboard();
             break;
         case "lawyer":
            $this->lawyer_dashboard();
             break;
         case "client":
             $this->client_dashboard();
             break;  
         default:
             redirect('/');
     }
      
   }
   public function lawyer_dashboard()
   {
      $cases=Policecase::where('lawyer_id',Auth()->user()->id)->get();
      $new = Hearing::whereHas('case', function ($query) {
         $query->where('lawyer_id', Auth()->user()->id)->where('status','in progress');
      })->where('next_date', '>=', date('Y-m-d'))->orderBy('next_date','asc')->get();

      $count=[
         'messages_total'=>Message::where('lawyer_id',Auth()->user()->id)->count(),
         'messages_pending'=>Message::where('lawyer_id',Auth()->user()->id)->where('time',NULL)->count(),
         'cases_in_progress'=>Policecase::where('lawyer_id',Auth()->user()->id)->where('status','in progress')->count()
      ];
      return view('lawyer',compact('cases','count','new'));
   }

   public function client_dashboard()
   {
      
      $cases=Policecase::where('client_id',Auth()->user()->id)->get();
      $new = Hearing::whereHas('case', function ($query) {
         $query->where('client_id', Auth()->user()->id)->where('status','in progress');
      })->where('next_date', '>=', date('Y-m-d'))->orderBy('next_date','asc')->get();

      $cases_progress=Policecase::where('client_id',Auth()->user()->id)->where('status','in progress')->get();
      $count=[
         'messages_total'=>Message::where('client_id',Auth()->user()->id)->count(),
         'messages_pending'=>Message::where('client_id',Auth()->user()->id)->where('time',NULL)->count(),
         'cases_in_progress'=>Policecase::where('client_id',Auth()->user())->where('status','completed')->count(),
      ];
      //dd($count);
      //$pending=Policecase::where('lawyer_id',Auth()->user()->id)->where('status','pending')->count();
      return view('client',compact('cases','cases_progress','count','new'));
   }

   public function admin_dashboard()
   {      
      $cases=Policecase::all();
      $cases_progress=Policecase::where('status','in progress')->get();
      $count=[
         'messages_total'=>Message::all()->count(),
         'messages_pending'=>Message::where('time',NULL)->count(),
         'cases_in_progress'=>Policecase::where('status','completed')->count(),
      ];
      return view('client',compact('cases','cases_progress','count'));
   }

   public function app($id)
   {
      $msg=Message::where('lawyer_id',Auth()->user()->id)->first();
      $messages=Message::where('id',$id)->get();
      $client=User::where('id',$msg->client_id)->first();
      
      return view('appointment-all',compact('messages','msg','client'));
   }
   public function approve_app(Request $request)
   {
      $msg=Message::where('id',$request->input('aid'))->first();
      $msg->time=date("Y-m-d H:i:s");
      $msg->status="approved";
      $msg->save();      
      $messages=Message::where('id',$request->input('aid'))->get();
      $client=User::where('id',$msg->client_id)->first();
      return view('appointment-all',compact('messages','msg','client'));
   }
   public function reject_app(Request $request)
   {
      $msg=Message::where('id',$request->input('aid'))->first();
      //$msg->
      //$client=User::where('id',$msg->client_id)->first();
      
      return view('appointment-all',compact('messages','msg','client'));
   }

   public function approve_case($id)
   {
      $c=Policecase::where('id',$id)->first();     
      $c->status="in progress";
      $c->save();      
      return redirect('case')->with('success', 'Congratulations! Case is Approved successfully!');
   }

  
}
