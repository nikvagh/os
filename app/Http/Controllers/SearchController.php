<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class SearchController extends Controller
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

        $data['needle'] = $needle = $request->needle;
        $token = $request->session()->get('token');
        // =================================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/home/search', [
                'form_params' => [
                    'needle' => $needle
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['serch_data'] = $result->data;
            }else{
                if($result->statusCode == 401){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if($result->statusCode == 451){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }
        // =====================================
        
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('search')->with($data);
    }
    
}
