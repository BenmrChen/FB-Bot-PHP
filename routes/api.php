<?php

use Illuminate\Http\Request;
use GuzzlHttp\Client;


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

Route::get('/webhook', function () {

    $verify_token = 'newMessengerL';
    $mode = request('hub_mode');
    $token = request('hub_verify_token');
    $challenge = request('hub_challenge');

    if (isset($mode) && isset($token)) {
        if ($mode == 'subscribe' && $token === $verify_token) {
            return response($challenge);
        } else {

            return response('', 403);
        }
    };
});

Route::post('/webhook', function (Request $request) {


    if ($request->object == 'page') {
        foreach ($request->entry as $entry) {
            $webhook_event = $entry['messaging'][0];
            $sender_psid = $webhook_event['sender']['id'];

        }
        handleMessage($sender_psid, $webhook_event);
        return response('EVENT_RECEIVED');
    } else {
        return response('', 404);
    }

});

function handleMessage($sender_psid, $webhook_event)
{
    $response = [
        'text'=>"Test{$webhook_event['message']['text']}",
    ];
    callSendAPI($sender_psid, $response);
}

function callSendAPI($sender_psid, $response)
{
    $request_body = [
        'recipient' => [
            'id' => $sender_psid,
        ],
        'message' => $response
    ];
    $client = new \GuzzleHttp\Client();
    $uri = "https://graph.facebook.com/v2.6/me/messages";


    $access_token = env('access_token');
    $client->post($uri, [
        GuzzleHttp\RequestOptions::QUERY=>["access_token"=>$access_token],

        GuzzleHttp\RequestOptions::JSON => $request_body
    ]);
}
