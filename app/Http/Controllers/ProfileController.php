<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class ProfileController extends Controller
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
        // exit;
        
        $data = array();

        $token = $request->session()->get('token');
        // exit;

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

        // =====================================
        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/order/history', [
        //         'form_params' => [],
        //         'headers' => [
        //             'Authorization' => config('constants.token_type').$token,
        //         ]
        //     ]);
        
        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());

        //     if($result->status){
        //        $data['order_history'] = $result->data;
        //     }else{
        //         if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
        //             Session::flash('message_e', config('constants.logout_msg'));
        //             return redirect('/login');
        //         }
        //         if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
        //             Session::flash('message_e', $result->message);
        //             return redirect('/login');
        //         }else{
        //             $data['order_history_msg'] = $result->message;
        //         }
        //     }
        // }

        // =====================================
        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/address/get_all', [
        //         'form_params' => [],
        //         'headers' => [
        //             'Authorization' => config('constants.token_type').$token,
        //         ]
        //     ]);
        
        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());

        //     if($result->status){
        //        $data['all_address'] = $result->data;
        //     }else{
        //         if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
        //             Session::flash('message_e', config('constants.logout_msg'));
        //             return redirect('/login');
        //         }
        //         if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
        //             Session::flash('message_e', $result->message);
        //             return redirect('/login');
        //         }else{
        //             $data['all_address_msg'] = $result->message;
        //         }
        //     }
        // }
        
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        if($request->tab){
            $data['tab'] = $request->tab;
        }else{
            $data['tab'] = "";
        }
        return view('profile')->with($data);
    }

    public function get_profile_block(Request $request){
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

        // =====================================
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/get_all', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            if($result->status){
               $data['all_address'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['all_address_msg'] = $result->message;
                }
            }
        }
        
        // return view('profile-block')->with($data);
        $data['view_data'] = view('profile-block')->with($data)->render();
        return response()->json($data);
    }

    public function get_order_block(Request $request){


        $data = array();
        
        $token = $request->session()->get('token');
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/order/history', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            if($result->status){
               $data['order_history'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    $data['re'] = '/login';
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    $data['re'] = '/login';
                }else{
                    $data['order_history_msg'] = $result->message;
                }
            }
        }

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // view('profile-order-block')->with('leads', json_decode($leads, true));
        
        
        // view('profile-order-block')->with(json_encode($data,true));
        // echo json_encode($data);

        // echo $view = view("profile-order-block",compact($data))->render();
        // return response()->json(['html'=>$view]);
        $data['view_data'] = view('profile-order-block')->with($data)->render();

        return response()->json($data);
    }

    public function load_balance_block(Request $request){
        $token = $request->session()->get('token');

        $data = array();
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/wallet/get_wallet', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['balance_history'] = $result->data;
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
        // print_r($data);
        // return view('balance_block')->with($data);

        $data['view_data'] = view('balance_block')->with($data)->render();
        return response()->json($data);
    }

    public function add_money(Request $request){

        $validator = Validator::make($request->all(), [
            "amount" =>" required|regex:/^\d+(\.\d{1,2})?$/"
        ], [
            'amount.required' => 'Please Enter Amount.',
            'amount.regex' => 'Please Enter Valid Amount.',
        ]);
        if ($validator->fails()) {
            $data['error'] = $validator->errors()->first();
            echo json_encode($data);
            exit;
        }

        $data['amount'] = $request->amount;
        echo json_encode($data);
        exit;

        // =========================== code on return 

        // $token = $request->session()->get('token');
        // $trx_id = time();
        // $payment_status = true;

        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/wallet/add_money', [
        //         'form_params' => [
        //             'amount' => $request->amount,
        //             'trx_id' => $trx_id,
        //             'payment_status' => $payment_status
        //         ],
        //         'headers' => [
        //             'Authorization' => config('constants.token_type').$token,
        //         ]
        //     ]);

        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());
        //     // print_r($result);

        //     if($result->status){
        //         $data['success'] = $result->message;
        //     }else{
        //         if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
        //             Session::flash('message_e', config('constants.logout_msg'));
        //             return redirect('/login');
        //         }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
        //             Session::flash('message_e', $result->message);
        //             return redirect('/login');
        //         }else{
        //             $data['error'] = $result->message;
        //         }
        //     }
        // }

        // // =================================

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
        //         $request->session()->put('user', $result->data);
        //     }
        // }

        // echo json_encode($data);
    }

    public function add_new_address(Request $request){

        // echo "<pre>";
        // print_r($request);
        // print_r($_POST);
        // echo "</pre>";  

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                    'contact' => 'required|numeric',
                    'email' => 'required|email',
                ], [
                    'name.required' => 'Please Enter Name.',
                    'email.required' => 'Please Enter Email.',
        ]);
        if ($validator->fails()) {
            // echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()->first()]);
            // echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()]);
            $data['error'] = $validator->errors()->first();
            echo json_encode($data);
            exit;
        }

        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/add_new', [
                'form_params' => [
                    'lat' => '23.729081',
                    'long' => '90.417819',
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'address2' => $_POST['address2'],
                    'contact' => $_POST['contact'],
                    'email' => $_POST['email'],
                    'is_primary' => $_POST['is_primary'],
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

    public function load_address(Request $request){
        $token = $request->session()->get('token');
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/get_all', [
            'form_params' => [],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            // echo "<pre>";print_r($result);
            // echo "</pre>";
            // exit;

            if($result->status){
                $data['all_address'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['all_address_msg'] = $result->message;
                }
            }
        }

        // print_r($data);
        // exit;

        $data['view_data'] = view('profile-address-block')->with($data)->render();
        return response()->json($data);
    }

    public function get_edit_address (Request $request){

        $token = $request->session()->get('token');
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/get', [
                'form_params' => [
                    'address_id' => $request->address_id
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            if($result->status){
                $address = $result->data;
                ?>
                    <div class="modal fade" id="edit-address">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Address</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <!-- <span class="msg-success width-100p"></span> -->
                                    <span class="msg-error width-100p"></span>

                                    <div class="new-addr-form">
                                        <form id="edit_address_frm" method="post">
                                            <div class="new-addr-form-input">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name_e" id="name_e" placeholder="Name" value="<?php echo $address->name; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address_e" id="address_e" placeholder="" value="<?php echo $address->address; ?>">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>House No./Flat No.</label>
                                                    <input type="text" name="address2_e" id="address2_e" placeholder="" value="<?php echo $address->address2; ?>">
                                                </div> -->
                                            </div>
                                            <div class="address-select">
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Primary address</a>
                                                    <input type="radio" name="is_primary_e" id="is_primary_e" <?php if($address->is_primary == 1){ echo "checked"; } ?>> <?php //echo $address->is_primary; ?>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Other delivery address</a>
                                                    <input type="radio" name="is_primary_e" checked="checked" <?php if($address->is_primary != 1){ echo "checked"; } ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="new-addr-form-input-b">
                                                <!-- <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <input type="text" placeholder="Area">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="tel" name="contact" id="contact" placeholder="">
                                                    </div>
                                                </div> -->

                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>House No./Flat No.</label>
                                                        <input type="text" name="address2_e" id="address2_e" placeholder="" value="<?php echo $address->address2; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="tel" name="contact_e" id="contact_e" placeholder="" value="<?php echo $address->contact; ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email_e" id="email_e" placeholder="Email" value="<?php echo $address->email; ?>">
                                                        <a href="#" class="invoice-email">
                                                            <img src="image/invoice-info.png"><span>Your invoice will be send to your email</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="address_id_e" id="address_id_e" placeholder="Email" value="<?php echo $address->_id; ?>">
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <a href="" class="btn btn-style" id="edit_address_btn">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                exit;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }
                if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    ?>
                    
                    <?php
                    // $data['all_address_msg'] = $result->message;
                }
            }
        }
    }

    public function update_address(Request $request){

        // echo "<pre>";
        // print_r($request);
        // print_r($_POST);
        // echo "</pre>";  

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                    'contact' => 'required|numeric',
                    'email' => 'required|email',
                ], [
                    'name.required' => 'Please Enter Name.',
                    'email.required' => 'Please Enter Email.',
        ]);
        if ($validator->fails()) {
            // echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()->first()]);
            // echo json_encode(['status' => false, 'title' => 'Error!', 'message' => $validator->errors()]);
            $data['error'] = $validator->errors()->first();
            echo json_encode($data);
            exit;
        }

        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/update', [
                'form_params' => [
                    'lat' => '23.729081',
                    'long' => '90.417819',
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'address2' => $_POST['address2'],
                    'contact' => $_POST['contact'],
                    'email' => $_POST['email'],
                    'is_primary' => $_POST['is_primary'],
                    'address_id' => $_POST['address_id'],
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

    public function delete_address(Request $request){

        // echo "<pre>";
        // print_r($request->all());
        // echo $request->address_id;
        // echo "</pre>";
        // exit;

        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/delete', [
                'form_params' => [
                    'address_id' => $request->address_id
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // print_r($result);
            // exit;

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

    public function change_address_status(Request $request){

        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/address/change_status', [
                'form_params' => [
                    'is_primary' => $request->is_primary,
                    'address_id' => $request->address_id
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

    public function order_repeat(Request $request){
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/order/repeat', [
            'form_params' => [
                "order_id" => $request->order_id
            ],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // print_r($result);
            // exit;
            if($result->status){
               $data['status'] = $result->status;
               $data['message'] = $result->message;
            }else{
                $data['status'] = $result->status;
                $data['message'] = $result->message;
            }
        }

        echo json_encode($data);
    }
    
}
