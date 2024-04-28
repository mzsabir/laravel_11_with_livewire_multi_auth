<?php

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public $query='';
    public $area="-";
    public $lawerys;
    public function boot() 
    {
        if($this->query!="" && strlen($this->query)>1)
        {
          
            //$brands=Brand::where('brand_name', 'LIKE','%'.$this->query.'%',)->get();
            //$coupons=Coupon::with('brand')->where('text', 'LIKE','%'.$this->query.'%',)->get();
        }
    }    
    public function search(){
      $this->lawerys=User::where('name','like','%'.$this->query.'%')->get();
      //dd($this->lawerys);
    }
    public function clear(){ 
        $this->query='';
        $this->lawerys='';
    }
}; ?>

<section class="ftco-section ftco-no-pt ftco-no-pb bg-light m-5">
      <div class="container">
        <div class="row d-flex justify-content-end">
        	<div class="col-md-12 py-4 px-md-4 bg-primary">
        		<div class="row">
		          <div class="col-md-4 ftco-animate d-flex align-items-center">
		            <h2 class="mb-0" style="color:white; font-size: 20px;">Search your favourite Lawyer</h2>
		          </div>
		          <div class="col-md-8 d-flex align-items-center">
		            <form action="#" class="subscribe-form">
		              <div class="form-group d-flex">
		                <input type="text" wire:model="query" class="form-control" placeholder="Search">&nbsp;&nbsp;
                    <select wire:model="area" style="width: 100%;" class="form-control">
                        <option value="-">Select Area</option>
                        <option value="Criminal">Criminal</option>
                        <option value="Corporate">Corporate</option>
                        <option value="Immigration">Immigration</option>
                        <option value="Family">Family</option>
                        <option value="Bankruptcy">Bankruptcy</option>
                        <option value="Durg Norcotics">Durg Norcotics</option>
                        <option value="Tax Lawyer">Tax Lawyer</option>
                        <option value="Real estate">Real estate</option>
                    </select>                        
		                <input wire:click="search" type="button" value="Search" class="submit px-3">
		              </div>
		            </form>
		          </div>
    @if(($lawerys) && ($lawerys->count()>0 || $lawerys->count()>0))
    
    <div style="position: absolute; top: 81px; background:#F2E5D7; left: 398px; margin:0 14px' width: 630px; min-height:100px; height:auto; max-height:500px; overflow:scroll; padding: 10px; z-index:-1">
        <!-- Brands Search -->
        @if($lawerys && $lawerys->count()>0)   
            <h6 style="background:#336699; padding:5px 10px; margin:0 10px 5px 10px; color:white; width:631px; margin-top:10px">Lawyers matching your Query: {{$query }} <span wire:click="clear" style="border:1px solid white; cursor:pointer; padding: 1px 8px; position:absolute; right:20px; top:15px">X</span></h6>
           
            <ul style="list-style: none;">
            @foreach($lawerys as $br)           
                <li style="border-bottom: 1px solid #ccccbb; display:flex; color:black; padding:0 12px; margin:10px 0"> 
                  <div><img src="{{url('images/users/'.$br->picture)}}" width="100" height="100"></div>
                  <div style="margin-left: 5px; width: 200px; border-right:1px solid black">
                    <h3>{{$br->name}}</h3> 
                    <h5>Area: {{$br->area}}</h5>
                    <h5>City: {{$br->city}}</h5>
                    
                  </div>
                  
                  <div style="padding-left:10px">
                    @guest
                    <a style="border: 1px solid gray;font-size: 14px; padding: 2px 5px; background: #e1dd89;" href="{{route('login')}}">Login for Appointment</a><br>
                    @else
                      @if(Auth()->user()->role!="lawyer")
                      <a style="border: 1px solid gray;font-size: 14px; padding: 2px 5px; background: #e1dd89;" href="{{url('appointment/'.$br->id)}}">Book an Appointment</a><br>
                      @endif
                    @endif
                    <div>Rating: {{rand(1,10)}}.{{rand(1,9)}} / 10</div>                           
                  </div>
                
                </li>
            @endforeach 
            </ul>
        @endif       
    </div>
    @elseif(strlen($query)>1)
        <div style="position: absolute; top: 60px; z-index:100; background: lightpink; left: 398px; width: 631px; padding: 15px;" class="search_error">No Result Found for: {{$query}}</div>
    @elseif(strlen($query)==1)
        <div style="position: absolute; top: 60px; background:lemonchiffon; left: 398px; width: 631px; padding: 15px;" class="search_error">Type more to search</div>
    @endif
    <div wire:loading style="position: absolute; top: 60px; background:lemonchiffon; left: 398px; width: 631px; padding: 10px;" class="search_error">
        <div class="spinner-border text-success" style="width: 25px; height:25px" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>


	          </div>
          </div>
        </div>
      </div>
    </section>

