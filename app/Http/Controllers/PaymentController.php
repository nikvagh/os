<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 

    // public $token;

    // public function __construct(Request $request)
    // {
    //     //blockio init
    //     $this->token = $request->session()->get('token');
    // }

    public function index(Request $request){
        $data = array();

        // echo "<pre>";
        // print_r($request->session()->all());
        // echo "</pre>";

        // $request->session()->forget('checkout');
        if (!$request->session()->has('checkout')) {
            // Session::flash('message_e', 'please check your cart again.');
            return redirect('/checkout');
            // return redirect('/cart');
        }
        
        return view('payment')->with($data);
    }

    function place_order(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        // exit;

        if (!$request->session()->has('checkout')) {
            // Session::flash('message_e', 'please check your cart again.');
            return redirect('/cart');
        }

        $data = array();
        $token = $request->session()->get('token');

        // ======================

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
                // echo json_encode(array("status" => "return_cart"));
                $data['status'] = false;
                $data['re'] = 'cart';
                echo json_encode($data);
                exit;
            }
        }

        // ======================

        $checkout = $request->session()->get('checkout');
        $trx_id = time();

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/order/order', [
                'form_params' => [
                    "address_id" => $checkout->address_id,
                    "payment_method" => $request->payment_method,
                    "trx_id" => $trx_id,
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
                Session::forget('checkout');
                Session::forget('offer');

                $request->session()->put('success_page_title','Order');
                $request->session()->put('success_page_msg','Order Placed Successfully');
                // echo "2222";
            }else{
                if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                    Session::flash('message_e', config('constants.logout_msg'));
                    // return redirect('/login');
                    $data['status'] = false;
                    $data['re'] = 'login';
                }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                    Session::flash('message_e', $result->message);
                    // return redirect('/login');
                    $data['re'] = 'login';
                }else{
                    $data['status'] = false;
                    $data['re'] = 'payment';
                    $data['message'] = $result->message;
                }
            }
        }

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

        echo json_encode($data);

    }

    
    
}
