<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/login', function () {
//     // return view('welcome');
//     echo 'Hello World';
// });

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// Route::get('foo/bar', function(){
//     return 'Hello World';
// });

// Route::get('/login', 'LoginController@login1');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    if (request()->fullUrl() === redirect()->back()->getTargetUrl()) {
        return redirect('/');
    }
    return redirect()->back();
});


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
});

Route::get('/clear1', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "All cache cleared";
});

Route::get('/clear-config', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

// composer dump autoload

Route::get('/cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


// Route::get('/updateapp', function()
// {
//     // Artisan::call('dump-autoload');
//     exec('composer dump-autoload');
//     echo 'dump-autoload complete';
// });

// Route::get('home', 'HomeController@index')->middleware('AuthenticateOs');;
// Route::get('/login', 'LoginController@index')->middleware('checkLogin1');
Route::get('/login', 'LoginController@index');
Route::post('login_otp_submit', 'LoginController@login_otp_submit');
Route::get('/otp_verify/{mobile}/{language?}', 'LoginController@otp_verify');
Route::post('login_otp_verify', 'LoginController@login_otp_verify');
Route::get('/logout', 'LoginController@logout');

// Route::group(['middleware' => ['checkLogin']], function(){
Route::middleware('checkLogin')->group(function () {
    
    Route::get('/', 'HomeController@index');
    Route::get('/popup_first_time', 'HomeController@popup_first_time');
    Route::post('change_language', 'HomeController@change_language');

    // Route::post('search/{needle}', 'SearchController@index');

    // Route::get('/search/{category}/{forum}', [
    // ]);
    // Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
    // Route::get('search/{needle}', 'SearchController@index');

    // Route::post('search_p', function(){
    //     // echo "5444";exit;

    //     $needle = Input::post('needle');
    //     // exit;
    //     // return Redirect::action('SearchController@index', array('needle'=>$needle));
    // });

    Route::match(['get', 'post'], 'search_p/{needle}', 'SearchController@index');

    Route::get('/ajax_search/{needle?}', 'SearchController@ajax_search');

    // Route::get('buscar/{nom}', 'FrontController@buscarPrd');

    Route::get('/profile/{tab?}', 'ProfileController@index');
    Route::post('/add_new_address', 'ProfileController@add_new_address');
    Route::post('/add_money', 'ProfileController@add_money');
    Route::post('delete_address', 'ProfileController@delete_address');
    Route::get('/load_address', 'ProfileController@load_address');
    Route::get('/load_balance_block', 'ProfileController@load_balance_block');
    Route::post('/order_repeat', 'ProfileController@order_repeat');

    Route::get('/get_edit_address/{address_id}', 'ProfileController@get_edit_address');
    Route::post('update_address', 'ProfileController@update_address');
    Route::get('/profile-block','ProfileController@get_profile_block');
    Route::get('/order-block','ProfileController@get_order_block');
    Route::post('change_address_status', 'ProfileController@change_address_status');

    Route::get('/setting', 'SettingController@index');
    Route::get('/get_edit_profil_block','SettingController@get_edit_profil_block');
    Route::get('/get_edit_notification_block','SettingController@get_edit_notification_block');
    Route::post('update_profile', 'SettingController@update_profile');
    Route::post('update_notification', 'SettingController@update_notification');

    Route::get('product/list/{cat_id}/{page_number}', 'ProductController@index');
    Route::get('/product_details/{product_id}', 'ProductController@product_details');
    Route::get('/load_more_product/{cat_id}/{page}', 'ProductController@load_more_product');

    Route::get('medicine/list/{page_number}', 'MedicineController@index');
    Route::get('/medicine_details/{medicine_id}', 'MedicineController@medicine_details');
    Route::get('/load_more_medicine/{page}', 'MedicineController@load_more_medicine');
    
    Route::get('disease/list/{page_number}', 'DiseaseController@index');
    Route::get('/disease_details/{dis_id}', 'DiseaseController@disease_details');
    Route::get('/load_more_disease/{page}', 'DiseaseController@load_more_disease');

    Route::get('/doctor_list', 'DoctorController@index');
    Route::get('/doctor_details/{doctor_id}', 'DoctorController@doctor_details');
    Route::post('/req_callback', 'DoctorController@req_callback');


    Route::get('/contact_us', 'CommonController@contact_us');

    // Route::get('/cart', 'CartController@index');
    Route::post('/add_to_cart', 'CheckoutController@add_to_cart');
    Route::post('/update_cart', 'CheckoutController@update_cart');
    Route::get('/checkout', 'CheckoutController@checkout');
    Route::get('/cart', 'CheckoutController@cart');
    Route::get('/load_cart_block', 'CheckoutController@load_cart_block');
    Route::get('/load_address_block', 'CheckoutController@load_address_block');
    // Route::get('/load_offer_block', 'CheckoutController@load_offer_block');
    Route::get('/offer', 'CheckoutController@get_offer');
    Route::post('/apply_coupon', 'CheckoutController@apply_coupon');
    Route::post('/offer_remove', 'CheckoutController@offer_remove');
    Route::post('/save_address_to_session', 'CheckoutController@save_address_to_session');

    Route::post('/send_to_payment', 'CheckoutController@send_to_payment');

    Route::get('/payment', 'PaymentController@index');
    Route::post('/place_order', 'PaymentController@place_order');

    Route::get('/success', 'SuccessController@index');




    Route::post('/payssl', 'SslCommerzPaymentController@index');
    Route::post('/add_moeny_to_wallet', 'SslCommerzPaymentController@add_money');

});

Route::get('testt', 'SslCommerzPaymentController@testt');

Route::get('/session_check', function () {
    echo "session_check";
    echo "<pre>";
    print_r(Request::session()->all());
});
// SSLCOMMERZ Start
// Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
// Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

// Route::post('/pay', 'SslCommerzPaymentController@index');
// Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success_ssl', 'SslCommerzPaymentController@success');
Route::post('/fail_ssl', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');
// Route::post('/cancel_ssl', function () {
//     echo "cancel";
//     echo "<pre>";
//     print_r(Request::session()->all());
// });

Route::post('/ipn_ssl', 'SslCommerzPaymentController@ipn');

//SSLCOMMERZ END

// Route::group(['middleware' => ['auth', 'verify.admin']], function(){
//     Route::get('admin/test', 'Admin\AdminController@index');
//     Route::get('admin/test2', 'Admin\AdminController@test2');
//     Route::get('admin/test3', 'Admin\AdminController@test3');
//     Route::get('admin/test4', 'Admin\AdminController@test4');
// });

// Route::get('/test', 'ShowProfile@test');

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
// $router->group(['prefix' => ''], function () use ($router) {
//     $router->get('all_country', 'ApiController@getAllCountry');
//     $router->post('login', 'MemberController@authenticate');
//     $router->post('registrationAcc', 'MemberController@createMember');
// //    $router->post('register', 'MemberController@createMember');
//     $router->post('registerFB', 'MemberController@createMember_fb');
//     $router->post('registerGoogle', 'MemberController@createMember_google');
//     $router->post('checkMember', 'MemberController@checkMember'); 
//     $router->post('forgotpassword', 'MemberController@forgotpassword');
//     $router->get('version[/{versionfor}]', 'MemberController@version');
//     $router->post('verifyChecksum', 'MemberController@verifyChecksum');
//     $router->post('paytm_response', 'MemberController@paytmResponse');
//     $router->post('paypal_response', 'MemberController@paypalResponse');
//     $router->post('instamojo_response', 'MemberController@instamojoResponse');
//     $router->post('razorpay_response', 'MemberController@razorpayResponse');
//     $router->post('add_money', 'MemberController@addMoney');
// });

// $router->group(['middleware' => 'auth'], function () use ($router) {
//     $router->get('announcement', 'MemberController@getAnnouncement');
//     $router->get('pin_match/{member_id}/{match_id}', 'MemberController@pinMatch');
//     $router->get('all_game', 'MemberController@getAllGame');
//     $router->get('lottery/{member_id}/{status}', 'MemberController@getAllLottery');
//     $router->get('single_lottery/{lottery_id}/{member_id}/', 'MemberController@singleLottery');
//     $router->get('all_ongoing_match/{game_id}/{member_id}', 'MemberController@getAllOngoingMatch');
//     $router->get('all_game_result/{game_id}/{member_id}', 'MemberController@getAllGameResult');
//     $router->get('all_play_match/{game_id}/{member_id}', 'MemberController@getAllPlayMatch');
//     $router->get('my_match/{member_id}', 'MemberController@getMyMatches');
//     $router->get('dashboard[/{member_id}]', 'MemberController@getDashboardDetails');
//     $router->get('payment', 'MemberController@getPaymentDetails');
//     $router->get('about_us', 'MemberController@aboutUs');
//     $router->get('customer_support', 'MemberController@customerSupport');
//     $router->get('leader_board', 'MemberController@leadeBoard');
//     $router->get('match_participate[/{match_id}]', 'MemberController@matchParticipate');
//     $router->get('my_profile[/{member_id}]', 'MemberController@myProfile');
//     $router->get('my_refrrrals[/{member_id}]', 'MemberController@myRefrrrals');
//     $router->get('my_statistics[/{member_id}]', 'MemberController@myStatistics');
//     $router->get('single_game_result[/{match_id}]', 'MemberController@singleGameResult');
//     $router->get('single_match/{match_id}/{member_id}', 'MemberController@singleMatch');
//     $router->get('terms_conditions', 'MemberController@termsConditions');
//     $router->get('top_players', 'MemberController@topPlayers');
//     $router->get('transaction', 'MemberController@transaction');
//     $router->get('join_match_single[/{match_id}]', 'MemberController@joinMatchSingle');
//     $router->get('youtube_link', 'MemberController@youTubeLink');
//     $router->get('withdraw_method', 'MemberController@withdrawMethod');

//     $router->post('update_myprofile', 'MemberController@updateMyprofile');
//     $router->post('withdraw', 'MemberController@withdraw');
//     $router->post('join_match_process', 'MemberController@joinMatchProcess');
//     $router->post('lottery_join', 'MemberController@joinLottery');
//     $router->post('paystack_response', 'MemberController@paystackResponse');
// });