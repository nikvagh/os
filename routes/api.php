<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/', 'ApiController@login1');
Route::post('/login1', 'ApiController@login1');

Route::post('/login', 'ApiController@authenticate');
Route::post('/signup', 'ApiController@signup');
Route::post('/addBid', 'ApiController@add_bid');