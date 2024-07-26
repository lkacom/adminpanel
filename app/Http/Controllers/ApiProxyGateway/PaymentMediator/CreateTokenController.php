<?php

namespace App\Http\Controllers\ApiProxyGateway\PaymentMediator;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\RequestException;

class CreateTokenController extends Controller
{


    public function store($justToken=false)
    {
        $url        = env('PAYMENT_MEDIATOR_API_URL');
        $client     = env('PAYMENT_MEDIATOR_API_CLIENT_ID');
        $secret     = env('PAYMENT_MEDIATOR_API_SECRET_KEY');
        $username   = env('PAYMENT_MEDIATOR_API_USERNAME');
        $password   = env('PAYMENT_MEDIATOR_API_PASSWORD');

        // API::Generate access token
        $http = new GuzzleHttp();

        try{
            $response = $http->POST($url.'/oauth/token',
                ['form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => $client,
                    'client_secret' => $secret,
                    'username'      => $username,
                    'password'      => $password,
                ]]);
            $content = $response->getBody()->getContents();
            return $justToken?json_decode($content)->access_token:$content;
        }
        catch (RequestException $response) {

            $content = $response->getResponse()?$response->getResponse()->getBody()->getContents():null;
            $code = $response->getCode()?$response->getCode():522;

            return abort($code,$content);
        }
    }
}
