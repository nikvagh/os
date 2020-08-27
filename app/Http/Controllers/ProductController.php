<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/products/get_cat_prod_w_pag', [
                'form_params' => [
                    "cat_id" => $request->cat_id,
                    "page" => $request->page_number-1,
                    "limit" => (config('constants.product_per_page')),
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);

            // echo "<pre>";
            // print_r($response);
            // exit;
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            
            if($result->status){
               $data['page_data'] = $result->data;
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
        
        $data['curr_page'] = $request->page_number;
        $data['cat_id'] = $request->cat_id;
        $data['page'] = $request->page_number-1;
        return view('product_list')->with($data);
    }

    public function load_more_product(Request $request){
        // echo "<pre>";
        // print_r($request->page);
        // echo "</pre>";

        $data = array();
        $token = $request->session()->get('token');
        $if_data = "N";

        $data['page'] = $request->page;
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/products/get_cat_prod_w_pag', [
            'form_params' => [
                "cat_id" => $request->cat_id,
                "page" => $request->page,
                "limit" => (config('constants.product_per_page')),
            ],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());

            // print_r($result);
            if($result->status){

                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // echo "<pre>";print_r($result->data);

               $data['page_data'] = $result->data;
               $if_data = "Y";
            }else{
                if(isset($result->statusCode)){
                    if($result->statusCode == config('constants.token_ex')){
                        Session::flash('message_e', config('constants.logout_msg'));
                        return redirect('/login');
                    }else if($result->statusCode == config('constants.user_delete_code')){
                        Session::flash('message_e', $result->message);
                        return redirect('/login');
                    }
                }
            }
        }

        if($if_data == "Y"){
            return view('product_list_block')->with($data);
        }else{
            return '';
        }
    }

    public function product_details(Request $request){
        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/products/get', [
                'form_params' => [
                    "prod_id" => $request->product_id
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['product'] = $result->data;
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

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('product_detail')->with($data);
    }

    
}
