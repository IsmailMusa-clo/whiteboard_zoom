<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth0\SDK\Auth0;
use GuzzleHttp\Client;  

class ZoomAuthController extends Controller
{
    public function login()
    {
        $auth0 = new Auth0([
            'domain' => env('AUTH0_DOMAIN'),
            'client_id' => env('AUTH0_CLIENT_ID'),
            'client_secret' => env('AUTH0_CLIENT_SECRET'),
            'redirect_uri' => route('zoom.auth.callback'),
            'audience' => 'https://api.zoom.us',
            'scope' => 'meeting:master',
        ]);

        return redirect($auth0->login());
    }

    public function callback(Request $request)
    {
        $auth0 = new Auth0(['domain' => env('AUTH0_DOMAIN'),
            'client_id' => env('AUTH0_CLIENT_ID'),
            'client_secret' => env('AUTH0_CLIENT_SECRET'),
            'redirect_uri' => route('zoom.auth.callback'),
            'audience' => 'https://api.zoom.us',
            'scope' => 'meeting:master',
        ]);

        $userInfo = $auth0->getUser();

         $accessToken = $userInfo['accessToken'];
 
    }

    public function callZoomApi(Request $request)
    {
        $accessToken = $request->session()->get('zoom_access_token');  

        $client = new Client();

        $response = $client->get('https://api.zoom.us/v2/users/me', [
            'headers' => [
                'Authorization' => 'ismail' . $accessToken,
                'Content-Type' => 'application/json',
                'X-Api-Key' => env('ZOOM_API_KEY'),
                'X-Api-Secret' => env('ZOOM_API_SECRET'), 
            ],
        ]);

        $data = json_decode($response->getBody(), true);
 
    }

}
