<?php

namespace App\Http\Controllers;
use DB;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Rule;

class ApiController extends Controller
{

    public function __construct() {
        // $this->base_url = env('APP_URL');
        // $data = DB::table('web_config')
        //         ->get();
        // foreach ($data as $row) {
        //     $this->system_config[$row->web_config_name] = $row->web_config_value;
        // }
    }

    public function login1(Request $request) {
        echo "login";
        echo "<pre>";print_r($request->all());
    }

    public function store(Request $request)
    {
        echo "store";exit;
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
                    'username' => 'required',
                    'password' => 'required',
                        ], [
                    'username.required' => 'Please Enter User Name.',
                    'password.required' => 'Please Enter Password.',
        ]);
        if ($validator->fails()) {
            // echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()->first()]);
            echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()]);
            exit;
        }
        $user = DB::table('members')
                ->where('username', $request->input('username'))
                ->orWhere('phone', $request->input('username'))
                ->orWhere('email', $request->input('username'))
                ->first();
        if ($user) {
            // if (md5($request->input('password')) == $user->password) {
            if ($request->input('password') == $user->password) {
                if ($user->status == 'Enable') {
                    $array['status'] = true;
                    $array['title'] = 'Login Success!';
                    $array['message'] = $user;
                    echo json_encode($array);
                    exit;
                } else {
                    $array['status'] = false;
                    $array['title'] = 'Login failed!';
                    $array['message'] = "ERROR: You are not active, please contact our support center.";
                    echo json_encode($array);
                    exit;
                }
            } else {
                $array['status'] = false;
                $array['title'] = 'Login failed!';
                $array['message'] = 'Password incorrect';
                echo json_encode($array);
                exit;
            }
        } else {
            $array['status'] = false;
            $array['title'] = 'Login failed!';
            $array['message'] = 'Username incorrect';
            echo json_encode($array);
            exit;
        }
    }

    public function signup(Request $request) {
        
        // echo "<pre>";print_r($request->all());
        $validator = Validator::make($request->all(), [

                    'name' => 'required',
                    'username' => 'required|unique:members',
                    'email' => 'required|unique:members|email',
                    'password' => 'required|min:6',
                    'confirm_password' => 'required|same:password|min:6',
                    'phone' => 'required|unique:members|numeric|digits_between:7,15',
                    // 'email_id' => [
                    //     'required',
                    //     Rule::unique('members')->where(function ($query) {
                    //         return $query->where('login_via', '0');
                    //     }),
                    // ],
                    
                ], [
                    'name.required' => 'Please enter user name .',
                    'username.unique' => 'Username already registered!',
                    'email.required' => 'Please enter email .',
                    'email.email' => 'Please enter valid email .',
                    'email.unique' => 'Email already registered!',
                    'password.required' => 'Please enter password .',
                    'confirm_password.required' => 'Please enter confirm password .',
                    'confirm_password.same' => 'Password & Confirm Password not same!',
                    'phone.required' => 'Please Enter Mobile Number.',
                    'phone.numeric' => 'Please Enter Numeric value for mobile number',
                    'phone.unique' => 'Mobile Number already registered!',
                ]
        );
        if ($validator->fails()) {
            // return response()->json(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()->first()]);
            return response()->json(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()]);
        } else {

            $qid = $request->has('qid') ? $request->input('qid'): '';

            $signup_data = [
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone'),
                'qid' => $qid,
                'profile_pic' => '',
                'notification' => 'off',
            ];
            $member_id = DB::table('members')->insertGetId($signup_data);

            $array['status'] = true;
            $array['title'] = 'Success!';
            echo json_encode($array);
            exit;
        }
    }

    public function add_bid(Request $request) {
        
        // echo "<pre>";print_r($request->all());
        $validator = Validator::make($request->all(), [
                    'member_id' => 'required',
                    'number_type' => 'required',
                    'number_subtype' => 'required',
                    'upgrade_type' => 'required',
                    'number' => 'required',
                    'starting_bid_amount' => 'required|numeric',
                    'duration_id' => 'required',
                    'fee_id' => 'required',
                    'accept_payment_type' => 'required'
                ], [
                    'member_id.required' => 'Member Id Not Found.',
                    'number_type.required' => 'Please Select Car Number Or Phone Number.',
                    'number_subtype.unique' => 'Please Select Types Of Number.',
                    'upgrade_type.required' => 'Please Select Bid Leval Standered Or Premium .',
                    'number.required' => 'Please Enter Number .',
                    'starting_bid_amount.required' => 'Please Select Starting Bid Amount .',
                    'duration_id.required' => 'Please Select Duration.',
                    'fee_id.required' => 'Fee is Required Field',
                    'accept_payment_type.required' => 'Please Select Payment Accept Mode',
                ]
        );
        if ($validator->fails()) {
            // return response()->json(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()->first()]);
            return response()->json(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()]);
        } else {

            $duration = DB::table('durations')
                ->where('id', $request->input('duration_id'))
                ->first();

                $bid_end_datetime = Date('Y-m-d H:i:s', strtotime('+'.$duration->no_of_days.' days'));

                // echo $bid_end_datetime;
                // echo "<pre>";
                // print_r($duration);
                // exit;

            $coupon = $request->has('coupon') ? $request->input('coupon'): '';
            $bid_data = [
                'member_id' => $request->input('member_id'),
                'number_type' => $request->input('number_type'),
                'number_subtype' => $request->input('number_subtype'),
                'upgrade_type' => $request->input('upgrade_type'),
                'number' => $request->input('number'),
                'starting_bid_amount' => $request->input('starting_bid_amount'),
                'duration' => $request->input('duration_id'),
                'fee' => $request->input('fee_id'),
                'coupon' => $coupon,
                'accept_payment_type' => $request->input('accept_payment_type'),
                'bid_end_datetime' => $bid_end_datetime,
                'notification' => 'off',
                'purchaser' => 0,
                'status' => 'Disable',
                'live' => 'N'
            ];
            $bid_id = DB::table('bids')->insertGetId($bid_data);

            $array['status'] = true;
            $array['title'] = 'Success!';
            $array['bid_id'] = $bid_id;
            echo json_encode($array);
            exit;
        }
    }

    public function getAllCountry()
    {
        echo "get country";
    }
}
