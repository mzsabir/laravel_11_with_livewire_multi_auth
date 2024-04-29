<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');           
        }

        $role=Auth::user()->role;
        if($role=="client"){
            return $next($request);
        }

        if($role=="lawyer"){
            return redirect()->route('lawyer');
        }
        else if($role=="admin"){
            return redirect()->route('admin');
        }else{
            return redirect()->route('login'); 
        }
    }
}
