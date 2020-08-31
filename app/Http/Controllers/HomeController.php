<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function test(){
    }

    public function index(Request $request){
        // echo "<pre>";
        // print_r(session()->all());
        // echo "</pre>";
        $data = array();

        $token = $request->session()->get('token');
        // =================================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/home/home_data', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['home_data'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == 401){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == 451){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }
        // =====================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/home/get_slider', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['slider'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == 401){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == 451){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }
        
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('index')->with($data);
    }

    public function popup_first_time(Request $request){

        $data = array();
        $token = $request->session()->get('token');

        // =================================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/change_show_bonus', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
            //    $data['profile'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }

        // =================================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/get_detail', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
                //    $data['profile'] = $result->data;
                $request->session()->put('user', $result->data);
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }

        return view('popup_first_time')->with($data);
    }


    public function change_language(Request $request){

        $data = array();
        $token = $request->session()->get('token');
        $change_language = "N";

        // =================================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/change_lang', [
                'form_params' => [
                    "language" => $request->language
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
                $change_language = "Y";
            }
        }

        // =================================================
        if($change_language == "Y"){
            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/users/get_detail', [
                    'form_params' => [],
                    'headers' => [
                        'Authorization' => config('constants.token_type').$token,
                    ]
                ]);
            
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                if($result->status){
                    // print_r($result);
                    $request->session()->put('user', $result->data);
                    $data['language'] = $result->data->language;
                }else{
                    if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        return redirect('/login');
                    }
                    if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        return redirect('/login');
                    }
                }
            }
        }

        echo json_encode($data);

    }
    
}
