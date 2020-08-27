<?php

namespace App\Http\Middleware;
use Closure;
use Session;

class AuthenticateOs1
{
    public function handle($request, Closure $next)
    {
        if (Session::has('token')) {
            // if(Session::get('token') != ""){
            //     echo "555";
            // }
            if($request->session()->get('token') != ""){
                // echo "111";exit;
                return redirect('/');
            }
        }
        return $next($request);
    }
}
