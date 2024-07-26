<?php
namespace App\Http\Controllers;

use App\Mail\ClientNewService;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiProxyGateway\PaymentMediator\CreateTokenController as Token;
use GuzzleHttp\Exception\RequestException;
use Mail;

class VerifyPaymentController extends Controller
{
    public User $user;

    // Detect webhook from API.payment-mediator
    public function show($transaction_id){
        $transaction = Transaction::where('transaction_id',$transaction_id)->get()->first();
        if($transaction){
            $this->user = $transaction->invoice->user;
            return $this->getTransactionResult($transaction);
        }
        return false;
    }

    public function store(Request $request){
        $params = $request->all();
        //Connect to Payment-Mediator service
        $url = 'https://api.payment-mediator.ga';
        $token = (new Token())->store(1)->access_token;

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->post($url . '/VerifyPayment', [$params])->object();

        try{
            $response = $http->POST($url . '/VerifyPayment',
                [
                    'headers' => [
                        'Accept' => $accept,
                        'Authorization' => 'Bearer '.$token,
                    ],
                    'form_params' => $params
                ]);
            $content = json_decode($response->getBody()->getContents());
            return view()->make('redirector')->with(['data' => $content]);
        }
        catch(RequestException $exception)
        {
            $transaction = $this->getTransaction();
            $content = json_decode($exception->getResponse()->getBody()->getContents());

            $content->data = $transaction;
            $content = json_encode($content);

            $code = $exception->getResponse()->getStatusCode();
            abort($code, $content);
        }
    }

    protected function getTransactionResult($transaction){
        $url    = env('PAYMENT_MEDIATOR_API_URL');
        $token  = (new Token())->store(1);

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                ->get($url . '/transactions/' . $transaction->transaction_id)
                ->object();

            $transaction->status = $response->data->code;
            $transaction->save();

            $invoice = $transaction->invoice;
            $invoice->status = $response->data->code;
            $invoice->save();

            if($invoice->status == 0){
                foreach($invoice->orders as $order){
                    $productDuration = $order->product->period->getRawOriginal('duration');
                    $expiryTime = Carbon::now()->addSeconds($productDuration);
                    $v2rayConfig = v2ray()->createClient($this->user,$expiryTime->timestamp*1000);

                    $order->attributes = json_encode(compact('v2rayConfig','expiryTime'));
                    $order->status = 1;
                    $order->save();

                    Mail::send(new ClientNewService($this->user,$order));
                    return true;
                }
            }
            return false;
        }
        catch (ConnectionException $e) {
            dd($e->getMessage());
        }
    }


}
