<?php

namespace App\Http\Controllers\ApiProxyGateway\PaymentMediator;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function store(Request $request){
        $url    = app('config')->get('beshkan.vpn.url');
        $accept = $request->header('contentType');
        $token  = $request->header('Authorization');

        $http = new GuzzleHttp();
        try{
            $response = $http->post($url.'/Invoices',
                [
                    'headers' => [
                    'Accept' => $accept,
                    'Authorization' => $token,
                    ],
                    'form_params' => $request->only(['products'])
                ]);
            return $response->getBody()->getContents();
        }
        catch (RequestException $response){

            $content = $response->getResponse()->getBody()->getContents();
            $code = $response->getCode();
            return abort($code,$content);
        }
    }
}
