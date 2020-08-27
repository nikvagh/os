<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // echo "<pre>";
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

        if(\Session::has('locale'))
        {
            \App::setlocale(\Session::get('locale'));
        }else if(\Session::has('user'))
        {
            $user = \Session::get('user');
            // echo $user->language;
            \App::setlocale($user->language);
            \Session::put('locale', $user->language);
        }
        // else{
        //     \App::setlocale('en');
        //     Session::put('locale', 'en');
        // }
        return $next($request);
    }
}
