<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Session;
use File;
use Cookie;
use Validator;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

        if (!$request->session()->has('checkout')) {
            Session::flash('message_e', 'please check your cart again.');
            return redirect('/cart');
        }

        $user = $request->session()->get('user');

        $checkout_old = $request->session()->get('checkout');
        $checkout_old->payment_method = $request->payment_method;
        $request->session()->put('checkout',$checkout_old);
        $checkout = $request->session()->get('checkout');
        $token = $request->session()->get('token');

        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/order/checkout', [
            'form_params' => [],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
                
            }else{
                Session::flash('message_e', 'please check your cart again.');
                return redirect('/cart');
            }
        }
        
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $checkout->grand_total; # You cant not pay less than 10
        $post_data['currency'] = config('constants.currency');
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = ($user->name != "") ? $user->name:'os';
        $post_data['cus_email'] = ($user->email != "") ? $user->email:'os@gmail.com';
        $post_data['cus_add1'] = $checkout->address_id;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "product";
        $post_data['product_category'] = "product";
        $post_data['product_profile'] = "product";

        # OPTIONAL PARAMETERS

        $ss = json_encode($request->session()->all());
        // $ss = $request->session()->all();
        // $session_txt = urlencode($ss);
        // echo $session_url;

        // $post_data['cart'] = json_encode($request->session()->get('checkout'));
        // $session_ar['token'] = $request->session()->get('token');
        $login_user = $session_ar['user'] = $request->session()->get('user');
        // $session_ar['checkout_address'] = $request->session()->get('checkout_address');
        // $session_ar['locale'] = $request->session()->get('locale');
        // Cookie::set("TestCookie", time() - 3600);

        $file = $login_user->_id.'.json';
        $destinationPath = public_path(config('constants.ssl_json_dir'));
        // if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$ss);
        // =====================
        // echo "<pre>";
        // print_r($session_ar);

        // $session_txt = http_build_query($session_ar);

        // echo $session_txt;
        // parse_str($session_txt, $output);
        // echo "<pre>";
        // print_r($output);
        // exit;

        $post_data['value_a'] = $login_user->_id;
        $post_data['value_b'] = "checkout_order";

        // exit;
        // $post_data['address_id'] = $checkout->address_id;
        // $post_data['payment_method'] = $request->payment_method;
        // $post_data['amount'] = $checkout->amount;
        // $post_data['delievery_fee'] = $checkout->delievery_fee;
        // $post_data['offer_code'] = $checkout->offer_code;
        // $post_data['discount'] = $checkout->discount;
        // $post_data['grand_total'] = $checkout->grand_total;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function testt(Request $request){
        echo "<pre>";
        print_r($request->session()->all());
        echo "</pre>";
        exit;
    }

    // public function set_session_new($user_id){

    //     $path = public_path('ssl/'.$user_id.".json");
    //     if(file_exists($path)){
    //         $json = json_decode(file_get_contents($path), true); 

    //         Session::put('token', $json['token']);
    //         Session::put('user', (object) $json['user']);
    //         Session::put('checkout_address', (object) $json['checkout_address']);
    //         Session::put('checkout', (object) $json['checkout']);
    //         Session::put('locale', $json['locale']);

    //         File::delete($path);
    //     }else{
    //         Session::flash('message_e', 'You are logged out. login again');
    //         return redirect('/login');
    //     }

    // }

    public function set_session_new($user_id){

        $path = public_path('ssl/'.$user_id.".json");
        if(file_exists($path)){
            $json = json_decode(file_get_contents($path), true); 
            // echo "<pre>";
            // print_r($json);
            // exit;
        
            // echo "<pre>";
            // print_r($json['checkout_address']);
            // print_r($json['checkout']);

            Session::put('token', $json['token']);
            Session::put('user', (object) $json['user']);

            if(isset($json['checkout_address'])){
                Session::put('checkout_address', (object) $json['checkout_address']);
            }
            if(isset($json['checkout'])){
                Session::put('checkout', (object) $json['checkout']);
            }
            if(isset($json['locale'])){
                Session::put('locale', $json['locale']);
            }

            // exit;
            // File::delete($path);
        }else{
            Session::flash('message_e', 'You are logged out. login again');
            return redirect('/login');
        }

    }
    

    public function success(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // $checkout = Session::get('checkout');
        // print_r($checkout);
        // echo "</pre>";
        // exit;

        $this->set_session_new($request->value_a);



        if($request->value_b == "add_money_wallet"){

                    // Session::flash('message_e', 'Payment Failed');
                    // return redirect('/profile/balance');

                    $token = $request->session()->get('token');
                    $trx_id = time();
                    $payment_status = true;

                    $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
                    $response = $client->post(config('constants.API_ROOT').'api/v1/wallet/add_money', [
                            'form_params' => [
                                'amount' => $request->amount,
                                'trx_id' => $request->tran_id,
                                'payment_status' => $payment_status
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
                            Session::flash('message_s', $result->message);
                            $re = "profile/balance";
                        }else{
                            if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                                Session::flash('message_e', config('constants.logout_msg'));
                                $re = "login";
                                // return redirect('/login');
                            }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                                Session::flash('message_e', $result->message);
                                $re = "login";
                                // return redirect('/login');
                            }else{
                                // $data['error'] = $result->message;
                                Session::flash('message_e', $result->message);
                                $re = "profile/balance";
                            }
                        }
                    }

                    // =================================

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
                        }
                    }

                    if($re == "login"){
                        return redirect('/login');
                    }else if($re == "profile/balance"){
                        return redirect('/profile/balance');
                    }

        }else{

                    $data = array(); $re = "";
                    $token = $request->session()->get('token');
                    $checkout = $request->session()->get('checkout');
                    // ======================

                    // $checkout = $request->session()->get('checkout');
                    // $trx_id = time();

                    $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
                    $response = $client->post(config('constants.API_ROOT').'api/v1/order/order', [
                            'form_params' => [
                                "address_id" => $checkout->address_id,
                                "payment_method" => $checkout->payment_method,
                                "trx_id" => $request->tran_id,
                                "amount" => $checkout->amount,
                                "delievery_fee" => $checkout->delievery_fee,
                                "offer_code" => $checkout->offer_code,
                                "discount" => $checkout->discount,
                                "grand_total" => $checkout->grand_total
                            ],
                            'headers' => [
                                'Authorization' => config('constants.token_type').$token,
                            ]
                        ]);
                    
                    if($response->getStatusCode() == 200){
                        $result = json_decode($response->getBody()->getContents());
                        // echo "<pre>";print_r($result);
                        // exit;
                        if($result->status){
                            $data['status'] = true;
                            
                            $request->session()->put('success_page_title','Order');
                            $request->session()->put('success_page_msg','Order Placed Successfully');
                            // return redirect('/success');
                            $re = "success";
                            // echo "2222";
                        }else{
                            if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                                Session::flash('message_e', config('constants.logout_msg'));
                                $re = "login";
                                // return redirect('/login');
                                // $data['status'] = false;
                                // $data['re'] = 'login';
                            }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                                Session::flash('message_e', $result->message);
                                $re = "login";
                                // return redirect('/login');
                                // $data['re'] = 'login';
                            }else{
                                $re = "payment";
                                // $data['status'] = false;
                                // $data['re'] = 'payment';
                                // $data['message'] = $result->message;
                                // return redirect('/payment');
                            }
                        }
                    }

                    Session::forget('checkout');
                    Session::forget('offer');

                    // $data['status'] = true;
                    // $request->session()->put('success_page_title','Order');
                    // $request->session()->put('success_page_msg','Your Order Has Been Placed Successfully.');

                    // ==========================

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
                        }
                    }

                    if($re == "login"){
                        return redirect('/login');
                    }else if($re == "payment"){
                        return redirect('/payment');
                    }else{
                        return redirect('/success');
                    }

        }

    }

    public function fail(Request $request)
    {
        $this->set_session_new($request->value_a);

        if($request->value_b == "add_money_wallet"){
            Session::flash('message_e', 'Payment Failed');
            return redirect('/profile/balance');
        }else{
            Session::flash('message_e', 'Payment Failed');
            return redirect('/checkout');
        }

        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

        // $tran_id = $request->input('tran_id');
        // $order_detials = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_detials->status == 'Pending') {
        //     $update_product = DB::table('orders')
        //         ->where('transaction_id', $tran_id)
        //         ->update(['status' => 'Failed']);
        //     echo "Transaction is Falied";
        // } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
        //     echo "Transaction is already Successful";
        // } else {
        //     echo "Transaction is Invalid";
        // }
    }

    public function cancel(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // echo $request->value_a;
        // exit;
        
        $this->set_session_new($request->value_a);

        if($request->value_b == "add_money_wallet"){
            // Session::flash('message_e', 'Payment Failed');
            return redirect('/profile/balance');
        }else{
            return redirect('/checkout');
        }

        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // echo $request->value_a;
        // exit;
        // parse_str($request->value_a, $old_session_data);
        // echo "<pre>";
        // print_r($old_session_data);

        // $tran_id = $request->input('tran_id');
        // $order_detials = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_detials->status == 'Pending') {
        //     $update_product = DB::table('orders')
        //         ->where('transaction_id', $tran_id)
        //         ->update(['status' => 'Canceled']);
        //     echo "Transaction is Cancel";
        // } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
        //     echo "Transaction is already Successful";
        // } else {
        //     echo "Transaction is Invalid";
        // }
        
    }

    public function payViaAjax(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "sss";
        $post_data['cus_city'] = "sss";
        $post_data['cus_state'] = "ss";
        $post_data['cus_postcode'] = "ss";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        // $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        // $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['emi_option'] = "1";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        $post_data["phone_number"] = "01711111111";







        $post_data["firstName"] = "John";
        $post_data["lastName"] = "Doe";
        $post_data["street"] = "93 B, New Eskaton Road";
        $post_data["city"] = "Dhaka";
        $post_data["state"] = "Dhaka";
        $post_data["postalCode"] = "1000";
        $post_data["country"] = "Bangladesh";
        // $post_data["email"] = "john.doe@email.com";

        $post_data["product_category"] = "Medicine";
        $post_data["product_name"] = "Medicine";
        // $post_data["previous_customer"] = "Yes";
        $post_data["shipping_method"] = "NO";
        $post_data["num_of_item"] = "1";


        $post_data["phone_number"] = "01711111111";

        $post_data['tokenize_id'] = "1";
        $post_data["product_profile_id"] = "5";
        $post_data["product_profile"] = "general";

        # OPTIONAL PARAMETERS
        // $post_data['value_a'] = "ref001";
        // $post_data['value_b'] = "ref002";
        // $post_data['value_c'] = "ref003";
        // $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        // echo "<pre>";
        // print_r($post_data);
        // echo "</pre>";
        // exit;

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    

    // public function ipn(Request $request)
    // {
    //     echo "ipn";
    //     echo "<pre>";
    //     print_r($request->all());
    //     print_r($request->session()->all());
    //     echo "</pre>";
    //     exit;

    //     #Received all the payement information from the gateway
    //     if ($request->input('tran_id')) #Check transation id is posted or not.
    //     {

    //         $tran_id = $request->input('tran_id');

    //         #Check order status in order tabel against the transaction id or order id.
    //         $order_details = DB::table('orders')
    //             ->where('transaction_id', $tran_id)
    //             ->select('transaction_id', 'status', 'currency', 'amount')->first();

    //         if ($order_details->status == 'Pending') {
    //             $sslc = new SslCommerzNotification();
    //             $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
    //             if ($validation == TRUE) {
    //                 /*
    //                 That means IPN worked. Here you need to update order status
    //                 in order table as Processing or Complete.
    //                 Here you can also sent sms or email for successful transaction to customer
    //                 */
    //                 $update_product = DB::table('orders')
    //                     ->where('transaction_id', $tran_id)
    //                     ->update(['status' => 'Processing']);

    //                 echo "Transaction is successfully Completed";
    //             } else {
    //                 /*
    //                 That means IPN worked, but Transation validation failed.
    //                 Here you need to update order status as Failed in order table.
    //                 */
    //                 $update_product = DB::table('orders')
    //                     ->where('transaction_id', $tran_id)
    //                     ->update(['status' => 'Failed']);

    //                 echo "validation Fail";
    //             }

    //         } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

    //             #That means Order status already updated. No need to udate database.

    //             echo "Transaction is already successfully Completed";
    //         } else {
    //             #That means something wrong happened. You can redirect customer to your product page.

    //             echo "Invalid Transaction";
    //         }
    //     } else {
    //         echo "Invalid Data";
    //     }
    // }

    public function add_money(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

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

        // if (!$request->session()->has('checkout')) {
        //     Session::flash('message_e', 'please check your cart again.');
        //     return redirect('/cart');
        // }

        $user = $request->session()->get('user');
        // $checkout_old = $request->session()->get('checkout');
        // $checkout_old->payment_method = $request->payment_method;
        // $request->session()->put('checkout',$checkout_old);
        $checkout = $request->session()->get('checkout');
        $token = $request->session()->get('token');

        // echo "<pre>";
        // print_r($request->all());
        // print_r($request->session()->all());
        // echo "</pre>";
        // exit;

        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/order/checkout', [
        //     'form_params' => [],
        //     'headers' => [
        //         'Authorization' => config('constants.token_type').$token,
        //     ]
        // ]);
        
        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());
        //     if($result->status){
                
        //     }else{
        //         Session::flash('message_e', 'please check your cart again.');
        //         return redirect('/cart');
        //     }
        // }
        
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = config('constants.currency');
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = ($user->name != "") ? $user->name:'os';
        $post_data['cus_email'] = ($user->email != "") ? $user->email:'os@gmail.com';
        $post_data['cus_add1'] = "address";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "product";
        $post_data['product_category'] = "product";
        $post_data['product_profile'] = "product";

        # OPTIONAL PARAMETERS

        $ss = json_encode($request->session()->all());
        // $ss = $request->session()->all();
        // $session_txt = urlencode($ss);
        // echo $session_url;

        // $post_data['cart'] = json_encode($request->session()->get('checkout'));
        // $session_ar['token'] = $request->session()->get('token');
        $login_user = $session_ar['user'] = $request->session()->get('user');
        // $session_ar['checkout_address'] = $request->session()->get('checkout_address');
        // $session_ar['locale'] = $request->session()->get('locale');
        // Cookie::set("TestCookie", time() - 3600);

        $file = $login_user->_id.'.json';
        $destinationPath = public_path(config('constants.ssl_json_dir'));
        // if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$ss);
        // =====================
        // echo "<pre>";
        // print_r($session_ar);

        // $session_txt = http_build_query($session_ar);

        // echo $session_txt;
        // parse_str($session_txt, $output);
        // echo "<pre>";
        // print_r($output);
        // exit;

        $post_data['value_a'] = $login_user->_id;
        $post_data['value_b'] = "add_money_wallet";

        // exit;
        // $post_data['address_id'] = $checkout->address_id;
        // $post_data['payment_method'] = $request->payment_method;
        // $post_data['amount'] = $checkout->amount;
        // $post_data['delievery_fee'] = $checkout->delievery_fee;
        // $post_data['offer_code'] = $checkout->offer_code;
        // $post_data['discount'] = $checkout->discount;
        // $post_data['grand_total'] = $checkout->grand_total;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

}
