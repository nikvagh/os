<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DiseaseController extends Controller
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

    public function load_more_disease(Request $request){

        // echo "<pre>";
        // print_r($request->page);
        // echo "</pre>";

        $data = array();
        $token = $request->session()->get('token');
        $if_data = "N";

        $data['page'] = $request->page;
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/otc_disease/get_all_w_pag', [
            'form_params' => [
                "page" => $request->page,
                "limit" => (config('constants.product_per_page')),
            ],
            'headers' => [
                'Authorization' => config('constants.token_type').$token,
            ]
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){

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
            // return view('disease_list_block')->with($data);
            $data['view_data'] = view('disease_list_block')->with($data)->render();
            return response()->json($data);

        }else{
            return '';
        }
    }

    public function disease_details(Request $request){

        $data = array();
        $token = $request->session()->get('token');

        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/otc_disease/get', [
                'form_params' => [
                    "dis_id" => $request->dis_id
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
        return view('disease_detail')->with($data);
    }

    // <nav>
    //     <ul class="pagination">
    //         <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">‹</span></li>
    //         <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
    //         <li class="page-item"><a class="page-link" href="/?page=2">2</a></li>
    //         <li class="page-item"><a class="page-link" href="/?page=2" rel="next" aria-label="Next »">›</a></li>
    //     </ul>
    // </nav>

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
}
