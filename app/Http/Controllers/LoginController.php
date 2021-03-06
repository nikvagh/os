<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Cookie;
use Illuminate\Http\Response;
use App\Http\Requests;

class LoginController extends Controller
{
    // public function login1() {
    //     // echo "login";
    //     // exit;
    //     $users = DB::table('members')->get();
    //     echo "<pre>";print_r($users);
    // }

    public function index(Request $request) {
        return view('login');
    }

    public function otp_verify($mobile,$language="en") {
        // print_r($request->all());
        $data['mobile'] = $mobile;
        $data['language'] = $language;
        return view('login2')->with($data);
    }

    public function login_otp_submit(Request $request)
    {
        // print_r($request->all());
        // exit;

        // $minutes = 60;
        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('name', 'MyValue'));
        // return $response;

        // $this->setCookie($request);

        // $this->getCookie($request);

        // $this->
        // $value = $request->cookie('name');
        // echo $value;
        // exit;

        // if($request->remember_me){
        //     echo "111";
        //     // Cookie::queue('mobile', $request->mobile);
        //     // Cookie::queue('mobile1', "kk");
        //     // $mk = Cookie::get('mobile');
        //     // $mk1 = Cookie::get('mobile1');

        //     // echo $mk;
        //     // echo $mk1;
        //     // echo "222";
        //     Cookie::forever('cookie', $request->mobile);

        //     echo $mobile = Cookie::get('cookie');
        // }
        // echo "333";
        // exit;



        $validator = Validator::make($request->all(), [
                    // 'mobile' => 'required|numeric|digits:11|',
                    'mobile' => 'required|numeric|regex:/^[0]{1}[0-9]{10}/',
                ], [
                    'mobile.required' => 'Please Enter Mobile Number.',
                    'mobile.numeric' => 'Please Enter Numeric value for mobile number',
                    'mobile.regex' => 'Please Enter Valid Mobile'
                ]
        );
        if ($validator->fails()) {
            // return view('login');
            // return Redirect::back()->withErrors($validator);
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            // print_r($request->all());
            $mobile = $request['mobile'];

            $language = 'bn';
            if(isset($request['language']) && $request['language'] == 'en'){
                $language = $request['language'];
            }

            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/users/send_otp', [
                    'form_params' => [
                        'mobile' => '+'.config('constants.mobile_prefix').'-'.$mobile,
                        'deviceToken' => 'token',
                        'language' => $language,
                        'os' => 'web',
                        // 'headers' => [
                        //     'Accept'     => 'application/json',
                        //     'Content-Type'     => 'application/json',
                        // ]
                    ]
                ]);

            // echo "<pre>";
            // print_r($response->getBody()->getContents());        
            // exit;

            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                if($result->status){
                    Session::flash('message_s', $result->message);
                    return redirect('/otp_verify/'.$mobile.'/'.$language);
                    // return redirect()->route('login/otp_verify/'.$mobile);
                    // return Redirect::route('/otp_verify/'.$mobile);
                    // Redirect::to('otp_verify?m='. $mobile);
                    // $data['mobile'] = $mobile;
                    // return view('login2',$data)->with($data);
                }else{
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }
                // echo "<pre>";
                // print_r($result);

                if($request->remember_me){
                    
                }


            }else{
              echo "error:new";  
            }
            
            // $res->getStatusCode(); // 200
            // $res->getHeaderLine('content-type'); // 'application/json; charset=utf8'
            // $res->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'


            // echo "<pre>";
            // print_r($res);
            // exit;

            // $qid = $request->has('qid') ? $request->input('qid'): '';

            // $signup_data = [
            //     'name' => $request->input('name'),
            //     'username' => $request->input('username'),
            //     'email' => $request->input('email'),
            //     'password' => $request->input('password'),
            //     'phone' => $request->input('phone'),
            //     'qid' => $qid,
            //     'profile_pic' => '',
            //     'notification' => 'off',
            // ];
            // $member_id = DB::table('members')->insertGetId($signup_data);

            // $array['status'] = true;
            // $array['title'] = 'Success!';
            // echo json_encode($array);
            // exit;
        }
    }

    public function login_otp_verify(Request $request){
        // print_r($request->all());
        // exit;

        $request['otps'] = "";
        if($request['otp'][0] != "" && $request['otp'][1] != "" && $request['otp'][2] != "" && $request['otp'][3] != "" && $request['otp'][4] != ""){
            $request['otps'] = $request['otp'][0].$request['otp'][1].$request['otp'][2].$request['otp'][3].$request['otp'][4];
        }
        
        $mobile = $request['mobile'];
        $validator = Validator::make($request->all(), [
                    'otps' => 'required',
                ], [
                    'otps.required' => 'Please Enter Full OTP.',
                ]
        );
        if ($validator->fails()) {
            return redirect('/otp_verify/'.$mobile)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/users/match_otp', [
                    'form_params' => [
                        'mobile' => '+'.config('constants.mobile_prefix').'-'.$mobile,
                        'otp' => $request['otps'],
                        // 'headers' => [
                        //     'Accept'     => 'application/json',
                        //     'Content-Type'     => 'application/json',
                        // ]
                    ]
                ]);

            // echo "<pre>";
            // print_r($response->getBody()->getContents());        
            // exit;

            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                if($result->status){

                    // echo "<pre>";
                    // print_r($result);
                    // exit;

                    $client1 = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
                    $response1 = $client1->post(config('constants.API_ROOT').'api/v1/users/get_detail', [
                        'form_params' => [],
                        'headers' => [
                            'Authorization' => config('constants.token_type').$result->data->token,
                        ]
                    ]);
                
                    $result1 = json_decode($response1->getBody()->getContents());
                    if(!$result1->status){
                        if($result1->statusCode == 401){
                            Session::flash('message_e', config('constants.logout_msg'));
                            return redirect('/login');
                        }
                    }

                    // echo "<pre>";print_r($result1->data);
                    // exit;

                    $request->session()->put('token', $result->data->token);
                    $request->session()->put('user', $result1->data);
                    
                    Session::flash('message_s', $result->message);
                    return redirect('/');
                }else{

                    // echo "<pre>";
                    // print_r($result);
                    // exit;

                    Session::flash('message_e', $result->message);
                    return redirect('/otp_verify/'.$mobile);
                }
                // echo "<pre>";
                // print_r($result);
            }else{
              echo "error:new";  
            }

        }

    }

    public function logout(Request $request){
        // echo "<pre>";
        // print_r(session()->all());
        // echo "</pre>";
        $request->session()->forget('token');
        $request->session()->forget('user');
        return redirect('/login');
    }

    public function setCookie(Request $request){
    //     // $minutes = 60;
    //     // print_r($request->all());
    //     // exit;    

        // Cookie::forever('mobile', $request->mobile);
        // echo $cookie = Cookie::get('mobile');
        // echo $request->mobile;
        // exit;

        setcookie('nik', 'nik1');

        echo Cookie::get('nik');

        // if(!isset($_COOKIE['nik'])) {
        //     echo $_COOKIE['nik'];
        // } else {
        //     echo "not set";
        // }

        $response = new Response('Set Cookie');
        $response->withCookie(cookie('mobile', $request->mobile),100);
        return $response;

    //     $minutes = 60;
    //     $response = new Response('Set mobile');
    //     $response->withCookie(cookie('mobile', $request->mobile, $minutes));
    //     return $response;
    }

    public function getCookie(Request $request){
        $value = $request->cookie('nik');
        echo "get";
        echo $value;
    }

}
