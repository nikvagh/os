<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;
use File;

class SettingController extends Controller
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
        // echo "</pre>";
        return view('setting');
    }

    public function get_edit_profil_block(Request $request){
        $token = $request->session()->get('token');

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
               $data['profile'] = $result->data;
            }else{
                if($result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if($result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }

        return view('profile-edit-block')->with($data);
    }

    public function get_edit_notification_block(Request $request){

        $data = array();
        $token = $request->session()->get('token');

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
               $data['profile'] = $result->data;
            }else{
                if($result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if($result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
            }
        }

        return view('profile-notification-block')->with($data);
    }


    public function update_profile(Request $request){

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    // 'address' => 'required',
                    'contact' => 'numeric',
                    'email' => 'required|email',
                ], [
                    // 'name.required' => 'Please Enter Name.',
                    // 'email.required' => 'Please Enter Email.',
        ]);
        if ($validator->fails()) {
            $data['error'] = $validator->errors()->first();
            echo json_encode($data);
            exit;
        }

        $token = $request->session()->get('token');


        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/change_name', [
                'form_params' => [
                    'name' => $request->name
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // print_r($result);

            if($result->status){
                // $data['success'] = $result->message;
                // echo json_encode($data);
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    $data['re'] = "login";
                    echo json_encode($data);
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    $data['re'] = "login";
                    echo json_encode($data);
                }else{
                    $data['error'] = $result->message;
                    echo json_encode($data);
                }
            }
        }

        // ===========================

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/change_email', [
                'form_params' => [
                    'email' => $request->email
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // print_r($result);

            if($result->status){
                // $data['success'] = $result->message;
                // echo json_encode($data);
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    $data['re'] = "login";
                    echo json_encode($data);
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    $data['re'] = "login";
                    echo json_encode($data);
                }else{
                    $data['error'] = $result->message;
                    echo json_encode($data);
                }
            }
        }

        // ====================

        if($request->hasFile('user_image')) {

            $file = $request->file('user_image');
            // echo "<pre>";
            // print_r($file);
            // echo "</pre>";

            // $fileName = time().'.'.$request->user_image->extension();  
            // $request->file->move(public_path('uploads'), $fileName);

            $name = $file->getClientOriginalName();  
            $file->move('uploads',$name);

            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/users/upload/profile', [

                    // 'multipart' => [
                    //     [
                    //         'name'     => 'user_image',
                    //         'contents' => fopen($file, 'r'),
                    //         // 'filename' => time().'.png'
                    //     ]
                    // ],
                    // 'multipart' => [
                    //     // [
                    //     //     'name'     => 'user_image',
                    //     //     'contents' => file_get_contents($_FILES['user_image']),
                    //     //     'filename' => 'user'.time()
                    //     // ],
                    //     [
                    //         'name'     => 'user_image',
                    //         'contents' => fopen('data://text/plain;base64,'.$file, 'r'),
                    //         'filename' => time().'.png'
                    //     ]
                    // ],
                    'headers' => [
                        'Authorization' => config('constants.token_type').$token
                    ],
                    'multipart' => [
                        [   
                            'Content-type' => 'multipart/form-data',
                            'name'     => 'user_image',
                            'contents' => fopen(public_path('uploads/'.$name), 'r'),
                            'user_image' => time().'.png'
                        ]
                    ]
                ]);
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                // print_r($result);

                if($result->status){
                    // $data['success'] = $result->message;
                    // echo json_encode($data);
                }else{
                    if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        $data['re'] = "login";
                    echo json_encode($data);
                    }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        $data['re'] = "login";
                        echo json_encode($data);
                    }else{
                        $data['error'] = $result->message;
                        echo json_encode($data);
                    }
                }
            }

            $image_path = public_path('uploads/'.$name);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            
        }

        // ====================

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
                $request->session()->put('user', $result->data);
            }else{
                if($result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    $data['re'] = "login";
                    echo json_encode($data);
                }else if($result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    $data['re'] = "login";
                    echo json_encode($data);
                }
            }
        }
        

        $new_data['success'] = "Profile Detail Updated successfully";
        if(\Session::has('user'))
        {
            if(Session::get('user')->image != ''){
                $new_data['image'] = \Session::get('user')->image;
            }
            $new_data['name'] = \Session::get('user')->name;
        }
        echo json_encode($new_data);
    }

    public function update_notification(Request $request){
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/users/change_noti_option', [
                'form_params' => [
                    'noti_status' => $request->noti_status
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // print_r($result);

            if($result->status){
                $data['success'] = $result->message;
                echo json_encode($data);
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['error'] = $result->message;
                    echo json_encode($data);
                }
            }
        }
    }

    
}
