<?php
namespace App\Http\Middleware;
use Closure;

class GetConstant
{
    public function handle($request, Closure $next)
    {   
        // echo "<pre>";
        // print_r($request->segment);
        // exit;

        // $country = $request->segment(1) == 'th' ? config('constants.langs.th') :  config('constants.langs.sg');
        // echo $country;
        // echo "ddd";
        // if (Session::has('your_params')) {
        //     $value = $request->session()->get('key');
        //     echo "111";
        // }else{
        //     echo "222";
        // }
        // exit;

        // if (!$request->session()->exists('user_token')) {
        //     // user value cannot be found in session
        //     return redirect('/');
        // }

        return $next($request);
    }
}
