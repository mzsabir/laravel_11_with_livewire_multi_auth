<?php

namespace App\Http\Controllers;

use App\Models\Hearing;
use App\Models\Policecase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases=Policecase::all();
        return view('case.index',compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lawyers=User::where('role',"lawyer")->get();
        return view('case.create',compact('lawyers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
        ]);
	
  	    $case =new Policecase(); 
        $case ->title=$req->input("title");
        $case ->act=$req->input("type");
        $case ->detail=$req->input("detail");
        $case ->slug=$req->input("title");
        $case ->client_id=Auth()->user()->id;
        $case ->lawyer_id=$req->input("lawyer_id");
        $case ->save();	
	    return redirect()->route('case.index')->with('success','Case created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $case=Policecase::where('id',$id)->first();
        $hearings=Hearing::where('case_id',$case->id)->get();
        $lawyer=User::where('id',$case->lawyer_id)->first();
        $client=User::where('id',$case->client_id)->first();
        
        return view('case.view',compact('case','lawyer','client','hearings'));
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
