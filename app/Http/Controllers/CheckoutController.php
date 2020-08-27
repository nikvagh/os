<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function add_to_cart(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        // exit;

        $items = array();
        foreach($request->capacity as $key=>$val){
            $data = (object) array();
            $data->capacity = $request['capacity'][$key];
            $data->qty = $request['qty'][$key];
            $data->arrange = false;
            if(isset($request['arrange'][$key])){
                $data->arrange = true;
            }

            $items[] = $data;
        }

        // $price_array = explode('_',$request->price_radio);
        // $price = $price_array[0];
        // $a_key = $price_array[1];

        // $arrange = false;
        // if(isset($request->arrange)){
        //     $arrange = true;
        // }
        
        // $data->qty = $request['qty'][$a_key];
        // $data->arrange = $arrange;

        // $items[] = $data;
        $item_data = json_encode($items);

        // echo $request->item_id;
        // echo "<br/>";
        // echo $item_data;
        // echo "<br/>";
        // echo $request->item_type;
        // exit;
        
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/cart/add', [
                'form_params' => [
                    "item_id" => $request->item_id,
                    "item_data" => $item_data,
                    "item_type" => $request->item_type,
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
                // echo "<pre>";print_r($result);
                // exit;
            //    $data['cart_data'] = $result->data;
               $data['status'] = $result->status;
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

        echo json_encode($data);
        // if($request->callback == "buy_more"){
        //     // return redirect()->route('/');
        //     // return redirect()->action('HomeController@index');
        // }else{
        //     return redirect('/checkout');
        // }
    }

    public function update_cart(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        $item_id = $request->item_id;

        // print_r($request->capacity[$item_id]);
        // exit;

        $items = array(); $empty_item = 'Y';
        foreach($request->capacity[$item_id] as $key=>$val){
            $data = (object) array();
            $data->capacity = $request->capacity[$item_id][$key];

            if(isset($request->qty[$item_id][$key])){
                $data->qty = $request->qty[$item_id][$key];
            }else{
                $data->qty = 0;
            }

            $data->arrange = false;
            if($request->arrange[$item_id][$key] != ""){
                $data->arrange = true;
            }
            $items[] = $data;

            if($data->qty > 0){
                $empty_item = "N";
            }
        }

        if($empty_item == 'Y'){
            $items = array();
        }

        // $price_array = explode('_',$request->price_radio);
        // $price = $price_array[0];
        // $a_key = $price_array[1];

        // $arrange = false;
        // if(isset($request->arrange)){
        //     $arrange = true;
        // }
        
        // $data->qty = $request['qty'][$a_key];
        // $data->arrange = $arrange;

        // $items[] = $data;
        $item_data = json_encode($items);

        // echo $request->item_id;
        // echo "<br/>";
        // echo $item_data;
        // echo "<br/>";
        // echo $request->item_type;
        // exit;
        
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/cart/add', [
            'form_params' => [
                "item_id" => $request->item_id,
                "item_data" => $item_data,
                "item_type" => $request->item_type,
            ],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
                // echo "<pre>";print_r($result);
                // exit;
                $data['status'] = true;
                $data['message'] = $result->message;
            }else{
                if($result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if($result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['status'] = false;
                    $data['message'] = 'Something Wrong. Cart Not Updated';
                }
            }
        }

        $request->session()->forget('checkout');
        echo json_encode($data);
        // if($request->callback == "buy_more"){
        //     // return redirect()->route('/');
        //     // return redirect()->action('HomeController@index');
        // }else{
        //     return redirect('/checkout');
        // }
    }

    public function load_cart_block(Request $request){
        $data = array();
        $data['empty_msg'] = "Cart is empty!";

        $token = $request->session()->get('token');
        
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // echo "<pre>";print_r($result);
            // exit;
            if($result->status){
               $data['cart_data'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['empty_msg'] = "Cart is empty!";
                }
            }
        }

        if(isset($data['cart_data']) && !empty($data['cart_data'])){
            
            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get_total', [
                    'form_params' => [],
                    'headers' => [
                        'Authorization' => config('constants.token_type').$token,
                    ]
                ]);
            
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                // echo "<pre>";print_r($result);
                // exit;
                if($result->status){
                    $total = $result->data;
                }else{
                    if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        return redirect('/login');
                    }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        return redirect('/login');
                    }
                }
            }


            $subtotal = $total->cart_count;
            $delivery_fee = 0;
            if($subtotal < 300){
                $delivery_fee = 49;
            }
            $discount = 0;

            $offer = array();
            if ($request->session()->exists('offer')) {
                $data['offer'] = $offer = $request->session()->get('offer');
                $discount = $subtotal*(($offer->discount)/100);
            }

            $total = $subtotal + $delivery_fee - $discount;

            $data['total_data'] = (object) array();
            $data['total_data']->subtotal = $subtotal;
            $data['total_data']->delivery_fee = $delivery_fee;
            $data['total_data']->discount = $discount;
            $data['total_data']->total = $total;
        }

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('cart_block')->with($data);
    }

    public function cart(Request $request){
        // return view('cart')->with($data);
        // echo "<pre>";
        // print_r($request->session()->all());
        // echo "</pre>";
        return view('cart');
    }

    public function checkout(Request $request){
        $data = array();
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

            if($result->status){
               $data['all_address'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['all_address_msg'] = $result->message;
                }
            }
        }
        // ==================================================

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // echo "<pre>";print_r($result);
            // exit;
            if($result->status){
               $data['cart_data'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['empty_msg'] = "Cart is empty!";
                }
            }
        }

        if(isset($data['cart_data']) && !empty($data['cart_data'])){
            
            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get_total', [
                    'form_params' => [],
                    'headers' => [
                        'Authorization' => config('constants.token_type').$token,
                    ]
                ]);
            
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                // echo "<pre>";print_r($result);
                // exit;
                if($result->status){
                    $total = $result->data;
                }else{
                    if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        return redirect('/login');
                    }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        return redirect('/login');
                    }
                }
            }

            // print_r($total);
            $subtotal = $total->cart_count;
            $delivery_fee = 0;
            if($subtotal < 300){
                $delivery_fee = 49;
            }
            $discount = 0;

            $offer = array();
            if ($request->session()->exists('offer')) {
                $data['offer'] = $offer = $request->session()->get('offer');
                $discount = $subtotal*(($offer->discount)/100);
            }

            $total = $subtotal + $delivery_fee - $discount;

            $data['total_data'] = (object) array();
            $data['total_data']->subtotal = $subtotal;
            $data['total_data']->delivery_fee = $delivery_fee;
            $data['total_data']->discount = $discount;
            $data['total_data']->total = $total;

            // echo "<pre>";
            // // print_r($data);
            // print_r($request->session()->all());
            // echo "</pre>";
            return view('checkout')->with($data);
        }else{
            return redirect('/cart');
        }
    }

    public function load_address_block(Request $request){
        $data = array();
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

            if($result->status){
               $data['all_address'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['all_address_msg'] = $result->message;
                }
            }
        }

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('checkout_address_block')->with($data);
    }

    public function load_offer_block(Request $request){
        $data = array();
        // $token = $request->session()->get('token');

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
        //         }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
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
        return view('checkout_offer_block')->with($data);
    }

    function get_offer(Request $request){
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/offers/get_available', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            if($result->status){
               $data['offers'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    // $data['empty_msg'] = $result->message;
                }
            }
        }

        $data['empty_msg'] = "Offer not available";

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('offer')->with($data);
    }

    function apply_coupon(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/offers/get_available', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            if($result->status){
                $offers = $result->data;
                foreach($offers as $key => $val){
                    if($request->offer_id == $val->_id){
                        $request->session()->put('offer', $offers[$key]);

                        // print_r($request->session()->all());
                        // exit;

                        $data['status'] = true;
                        $data['message'] = "offer Applied successfully!";
                        break;
                    }
                }
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['status'] = false;
                    $data['message'] = "offer can not be applied!";
                }
            }
        }

        echo json_encode($data);
    }

    function offer_remove(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        $request->session()->forget('offer');
        return redirect('checkout');
    }

    function save_address_to_session(Request $request){
        $new_array = (object) array();
        $new_array->address_id = $request->address_id;
        $new_array->address_radio = $request->address_radio;
        $request->session()->put('checkout_address',$new_array);
    }

    function send_to_payment(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        $token = $request->session()->get('token');
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            // echo "<pre>";print_r($result);
            // exit;
            if($result->status){
               $data['cart_data'] = $result->data;
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    return redirect('/login');
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    return redirect('/login');
                }else{
                    $data['empty_msg'] = "Cart is empty!";
                }
            }
        }

        if(isset($data['cart_data']) && !empty($data['cart_data'])){
            
            $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
            $response = $client->post(config('constants.API_ROOT').'api/v1/cart/get_total', [
                    'form_params' => [],
                    'headers' => [
                        'Authorization' => config('constants.token_type').$token,
                    ]
                ]);
            
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                // echo "<pre>";print_r($result);
                // exit;
                if($result->status){
                    $total = $result->data;
                }else{
                    if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        return redirect('/login');
                    }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        return redirect('/login');
                    }
                }
            }
            
        }

        // print_r($total);
        $subtotal = $total->cart_count;
        $delievery_fee = 0;
        if($subtotal < 300){
            $delievery_fee = 49;
        }

        $offer_code = "";
        $discount = 0;

        $offer = array();
        if ($request->session()->exists('offer')) {
            $data['offer'] = $offer = $request->session()->get('offer');
            $discount = $subtotal*(($offer->discount)/100);
            $offer_code = $offer->offer_code;
        }

        $total = $subtotal + $delievery_fee - $discount;
        $checkout_token = time();

        $new_array = (object) array();
        $new_array->address_id = $request->address_id;
        $new_array->address_radio = $request->address_radio;
        $new_array->amount = $subtotal;
        $new_array->delievery_fee = $delievery_fee;
        $new_array->offer_code = $offer_code;
        $new_array->discount = $discount;
        $new_array->grand_total = $total;
        $new_array->checkout_token = $checkout_token;

        $request->session()->put('checkout',$new_array);

        $r_data['status'] = true;
        $r_data['checkout_token'] = $checkout_token;
        echo json_encode($r_data);
        // return redirect('payment');
    }

}