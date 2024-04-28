<?php

namespace App\Http\Controllers;

use App\Models\Hearing;
use App\Models\Policecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HearingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->role=="client")
        {
            $hearings = Hearing::with('case')->whereHas('case', function ($query) {
                $query->where('client_id', Auth()->user()->id); // Filter cases by lawyer ID
            })->get();
            return view('hearing.index',compact('hearings'));


        }else if(Auth()->user()->role=="lawyer"){
            $hearings = Hearing::with('case')->whereHas('case', function ($query) {
                $query->where('lawyer_id', Auth()->user()->id); // Filter cases by lawyer ID
            })->get();
            return view('hearing.index',compact('hearings'));
        }else{
            $hearings=Hearing::all();
            return view('hearing.index',compact('hearings'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cases=Policecase::all();
        return view('hearing.create',compact('cases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'judge' => 'required',
        ]);

      
        /*"case_id" => "1"
        "court" => "District Court"
        "city" => "Peshawar"
        "judge" => "Marie Conn"
        "hearing_date" => "2025-03-08"
        "next_date" => "2025-04-01"
        "comment" => "Sporer - DuBuque"
        "result" => "Iste incidunt id tempora facere ea saepe consequatur."*/
	
        //Policecase::create($req->all()); 
        
        //dd($req->input("lawyer_id"));
  	    $hearing =new Hearing(); 
        $hearing ->case_id=$req->input("case_id");
        $hearing ->court=$req->input("court");
        $hearing ->judge=$req->input("judge");
        $hearing ->city=$req->input("city");
        $hearing ->hearing_date=$req->input("hearing_date");
        $hearing->next_date=$req->input("next_date");
        $hearing->comment=$req->input("comment");
        $hearing->result=$req->input("result");
        $hearing ->save();
	
	    return redirect()->route('hearing.index')->with('success','Hearing added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
