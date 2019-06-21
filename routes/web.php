<?php

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

use Illuminate\Http\Response;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/webhook', function(){
////    $uri = request()->path();  //這個是取得完整的URI
////    dd(request()->all()); //   //這?個是取得完整的Request String的key & value
//    $verify_token = 'newMessengerL';
//    $mode = request('hub_mode'); //記得要把原來的hub.mode改成hub_mode 因為laravel會把.改成_
//    $token = request('hub_verify_token');
//    $challenge = request('hub_challenge');
//
//    if(isset($mode) && isset($token)){
//        if($mode == 'subscribe' && $token === $verify_token){
//            return response($challenge);
//        };
//    } else {
////        return response('',Response::HTTP_FORBIDDEN); //這樣寫更readable
//        return response('', 403);
//    };
//});
//
//Route::post('/webhook', function(){
//    $body = request()->input();
//    return($body);
//});

// http://newmessengerl.test/webhook?hub.verify_token=newMessenger&hub.challenge=CHALLENGE_ACCEPTED&hub.mode=subscribe%22
// curl -H "Content-Type: application/json" -X POST "newmessengerl.test/webhook" -d '{"object": "page", "entry": [{"messaging": [{"message": "TEST_MESSAGE"}]}]}'
