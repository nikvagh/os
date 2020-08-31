<?php

namespace App\Http\Middleware;
use Closure;
use Session;

use Illuminate\Http\RedirectResponse;

class AuthenticateOs
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     echo "dffdff";
    //     exit;
    //     // if (! $request->expectsJson()) {
    //     //     return route('login');
    //     // }
    // }

    public function handle($request, Closure $next)
    {
        // $session = session()->all();
        // echo "<pre>";
        // print_r(session()->all());
        // echo "</pre>";
        
        if (Session::has('token')) {
            // if(Session::get('token') != ""){
            //     echo "555";
            // }

            if($request->session()->get('token') != ""){
                // echo "111";exit;
                return $next($request);
            }
        }else{
            if ($request->ajax()) {

                if($request->wantsJson()){
                    // echo "json";
                    // exit;

                    // $data['status'] = 'false';
                    $data['re'] = 'login';
                    // return response([
                    //     'status' => 'false',
                    //     're' => 'login',
                    // ], 200);
                    echo json_encode($data);
                    exit;
                }else{

                    // abort(404);
                    // echo url('/');
                    // header("Location: test");

                    // $response = $next($request);
                    // $response = $response instanceof RedirectResponse ? $response : response($response);
                    // return $response->header('refresh', '5;url=' . url('/login'));

                    // exit;

                    // echo "html";
                    // exit;
                    // return redirect()->guest('/login');
                    // return redirect('/login');

                }

            }
        }

        return redirect('/login');

    }
}
