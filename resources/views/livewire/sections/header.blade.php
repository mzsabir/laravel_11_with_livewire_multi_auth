<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
new class extends Component
{
    public $query='';
    public $user;
    public $messages;
    public function boot() 
    {
        $this->user=Auth::user();
        //$this->messages=DB::table('messages')->where('lawyer_id',$this->user->id)->get();
        $this->messages=Message::where('lawyer_id',$this->user->id)->get();
        //dd($this->messages);
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: false);
    }
}; ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="/" class="logo d-flex align-items-center">
    <img src="{{url('assets/img/logo.png')}}" alt="Best Lawyer Logo">
    <span class="d-none d-lg-block">Best Lawyer</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div>
    <div class="search-bar">
        <div autocomplete="off" class="search-form d-flex align-items-center">
            <input type="text" id="search_box" wire:model="query" placeholder="Search Lawyer" title="Enter search keyword">
            @if(strlen($query)>0)
                <div style="margin-left:-30px; font-size:24px; cursor:pointer" wire:click="clear" title="Clear"><i class="bi bi-x"></i></div>
            @else
                <button title="Search"><i class="bi bi-search"></i></button>
            @endif
            {{$query}}
        </div>
    </div>   
  
</div>


<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown">
      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if($messages->count()>0)
        <span class="badge bg-primary badge-number">
          
            {{$messages->count()}}
          
        </span>
        @endif
      </a><!-- End Notification Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have {{$messages->count()}} new Appointment
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        @foreach($messages as $m)
        <li class="notification-item">
          <i class="bi bi-exclamation-circle text-warning"></i>
          <div>
            <a href="/app/{{$m->id}}">
              <h4>{{$m->subject}}</h4>
              <p>{{$m->name}}</p>
              <p>{{$m->created_at}}</p>
            </a>
          </div>
        </li>      
        <li>
          <hr class="dropdown-divider">
        </li>
        @endforeach

        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
          <a href="#">Show all Appoitments</a>
        </li>

      </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->

   

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="{{url('images/users/'.$user->picture)}}" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">{{$user->name}}</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ucfirst($user->role)}}</h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{route('profile')}}">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a wire:click="logout" class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-box-arrow-right"></i>
            <span>Log Out</span>
          </a>
          <!-- <button  class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button> -->
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->




