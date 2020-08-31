<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

// use Illuminate\Http\Request;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {   
        // echo "<pre>";
        // print_r(Session::all());
        // echo "</pre>";

        // if (Session::has('token')) {
            // echo "111";

            // $token = $request->session()->get('token');
            // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            // $response = $client->post(config('constants.API_ROOT').'api/v1/users/get_detail', [
            //         'form_params' => [],
            //         'headers' => [
            //             'Authorization' => config('constants.token_type').$token,
            //         ]
            //     ]);
            
            // if($response->getStatusCode() == 200){
            //     $result = json_decode($response->getBody()->getContents());
            //     if($result->status){
            //     $data['profile'] = $result->data;
            //     }else{
            //         if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
            //             Session::flash('message_e', config('constants.logout_msg'));
            //             return redirect('/login');
            //         }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
            //             Session::flash('message_e', $result->message);
            //             return redirect('/login');
            //         }
            //     }
            // }

            // return view('profile-edit-block')->with($data);
            // $data['view_data'] = view('profile-edit-block')->with($data)->render();
            // return response()->json($data);

        // }else{
            // echo "222";
        // }

    }
}
