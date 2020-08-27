<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class SuccessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        // echo "<pre>";
        // print_r(session()->all());
        // print_r($request->all());
        // echo "</pre>";
        // exit;

        $data = array();

        if (!$request->session()->has('success_page_msg')) {
            return redirect('/');
        }

        $data['title'] = $request->session()->get('success_page_title');
        $data['message'] = $request->session()->get('success_page_msg');
        
        return view('success')->with($data);
    }
    
}
