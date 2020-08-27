<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorController extends Controller
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
        $response = $client->post(config('constants.API_ROOT').'api/v1/otc_disease/get_all_w_pag', [
            'form_params' => [
                "page" => $request->page_number-1,
                "limit" => (config('constants.product_per_page')),
            ],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){

                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // $result->data[] = $result->data[0];
                // echo "<pre>";print_r($result->data);

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
        $data['page'] = $request->page_number-1;
        // $data['pagination'] = $this->paginate($data['page_data']);
        return view('disease_list')->with($data);
    }

    public function doctor_details(Request $request){

        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/doctors/get_detail', [
                'form_params' => [
                    "doc_id" => $request->doctor_id
                ],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $data['doctor'] = $result->data;
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
            }
        }


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('doctor_detail')->with($data);
    }

    public function req_callback(Request $request){
        $data = array();
        $token = $request->session()->get('token');

        // print_r($request->all());
        // exit;

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/doctors/req_callback', [
            'form_params' => [
                "doc_id" => $request->doc_id
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
                // if(isset($result->statusCode) && $result->statusCode == config('constants.token_ex')){
                //     Session::flash('message_e', config('constants.logout_msg'));
                //     $data['status'] = $result->status;
                //     $data['re'] = 'login';
                // }else if(isset($result->statusCode) && $result->statusCode == config('constants.user_delete_code')){
                //     Session::flash('message_e', $result->message);
                //     $data['status'] = $result->status;
                //     $data['re'] = 'login';
                // }else{
                    $data['status'] = $result->status;
                    $data['message'] = $result->message;
                // }
            }
        }

        echo json_encode($data);
    }
    
}
