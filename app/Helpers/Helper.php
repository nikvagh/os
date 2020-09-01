<?php

if (!function_exists('get_header')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function get_header()
    {
        $token = session('token');

        $home_data = array();
        $client = new \GuzzleHttp\Client(['verify' => config('constants.Guzzle.ssl')]);
        $response = $client->post(config('constants.API_ROOT').'api/v1/home/home_data', [
                'form_params' => [],
                'headers' => [
                    'Authorization' => config('constants.token_type').$token,
                ]
            ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if($result->status){
               $home_data = $result->data;
            }else{
                // if(isset($result->statusCode) && $result->statusCode == 401){
                //     Session::flash('message_e', config('constants.logout_msg'));
                //     return redirect('/login');
                // }
                // if(isset($result->statusCode) && $result->statusCode == 451){
                //     Session::flash('message_e', $result->message);
                //     return redirect('/login');
                // }
            }
        }

        $result = array();
        foreach($home_data as $key=>$val){
            if($val->cat_type == "products"){
                if(!empty($val->category_data)){
                    $new = array();
                    $new['name'] = $val->cat_name;
                    $new['cat_id'] = $val->cat_id;

                    $result[] = $new;
                ?>
        
                    <!-- <li class="nav-item">
                        <a class="nav-title" href="{{ url('product/list/') }}'$val->cat_id/1">
                            <span>{{ __('messages.Medical_Equipment') }}</span>
                        </a>
                    </li> -->

                <?php

                }
            }
        }

        // echo "<pre>";
        // print_r($home_data);
        // print_r($result);
        // echo "</pre>";
        // exit;

        return $result;

    }
}