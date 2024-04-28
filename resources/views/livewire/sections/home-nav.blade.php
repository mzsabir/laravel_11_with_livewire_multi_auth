<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public function boot() 
    {
    }
}; ?>
            <ul class="navbar-nav ml-auto">
	          <li class="nav-item @if((Route::current()->uri()== '/')) active @endif"><a href="/" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="http://127.0.0.1:8000/appointment/1" class="nav-link">Attorneys</a></li>
	          <li class="nav-item"><a href="/practice-areas" class="nav-link">Practice Areas</a></li>
	          <li class="nav-item"><a href="/case-studies" class="nav-link">Case Studies</a></li>
	          
               @if (Route::has('login'))
                @auth
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Dashboard ({{ucfirst(Auth()->user()->role)}})</a></li>
                @else
                @if (Route::has('register'))
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Register</a></li>            
                @endif
                @endauth
                @endif
	          <li class="nav-item cta @if((Route::current()->uri()== 'appointment')) active @endif""><a href="http://127.0.0.1:8000/appointment/1" class="nav-link">Free Consultation</a></li>
	        </ul>


