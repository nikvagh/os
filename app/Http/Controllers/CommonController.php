<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;

class CommonController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function contact_us(Request $request){
        $data = array();
        // $token = $request->session()->get('token');

        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/products/get_cat_prod_w_pag', [
        //         'form_params' => [
        //             "cat_id" => $request->cat_id,
        //             "page" => $request->page_number-1,
        //             "limit" => (config('constants.product_per_page')),
        //         ],
        //         'headers' => [
        //             'Authorization' => config('constants.token_type').$token,
        //         ]
        //     ]);

        //     // echo "<pre>";
        //     // print_r($response);
        //     // exit;
        
        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());
            
        //     if($result->status){
        //        $data['page_data'] = $result->data;
        //     }else{
        //         if($result->statusCode == config('constants.token_ex')){
        //             Session::flash('message_e', config('constants.logout_msg'));
        //             return redirect('/login');
        //         }
        //         if($result->statusCode == config('constants.user_delete_code')){
        //             Session::flash('message_e', $result->message);
        //             return redirect('/login');
        //         }
        //     }
        // }

        // // =====================================
        // $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        // $response = $client->post(config('constants.API_ROOT').'api/v1/home/get_slider', [
        //         'form_params' => [],
        //         'headers' => [
        //             'Authorization' => config('constants.token_type').$token,
        //         ]
        //     ]);
        
        // if($response->getStatusCode() == 200){
        //     $result = json_decode($response->getBody()->getContents());
        //     if($result->status){
        //        $data['slider'] = $result->data;
        //     }else{
        //         if($result->statusCode == 401){
        //             Session::flash('message_e', config('constants.logout_msg'));
        //             return redirect('/login');
        //         }
        //         if($result->statusCode == 451){
        //             Session::flash('message_e', $result->message);
        //             return redirect('/login');
        //         }
        //     }
        // }
        
        return view('contact_us')->with($data);
    }
    
}
