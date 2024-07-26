<?php
namespace App\Orchid\Screens\Client;


use App\Http\Controllers\ApiProxyGateway\PaymentMediator\CreateTokenController as Token;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Transaction;
use Auth;
use Http;
use Illuminate\Support\Arr;
use Orchid\Screen\Screen;

class OrderScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.order.new'];
    }

    public function new()
    {
        if(Auth::user()->hasAccess('client.order.new')){
            $products = Product::find(request()->only('product'));
            $invoice = (new Invoice)->create($products);
            if ($invoice->amount === 0) {
                return v2ray()->createClient(Auth::user());
            } else {
                $transaction = $this->createTransaction($invoice);
                return view('redirectForm')->with(
                    [
                        'action' => $transaction->payment_url,
                        'inputs' => [
                            'transaction_id' => $transaction->transaction_id,
                            'tracking_cookie' => $transaction->tracking_cookie,
                        ],
                        'method' => 'POST',
                    ]
                );
            }
        }
        else abort(403);
    }

    protected function createTransaction(Invoice $invoice)
    {

        //Connect to Payment-Mediator service
        $url    = env('PAYMENT_MEDIATOR_API_URL');
        $token = json_decode((new Token())->store())->access_token;



        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->post($url . '/transactions', [
                'gateway' => 'jibit',
                'amount' => $invoice->amount,
                //'tracking_code' => $invoice->getAttribute('trackingId')->id,
                'return_url' => url('verify-payment'),
                'comment' => 'A comment for test',
            ])->object();


        $transaction = new Transaction;
        $transaction->fill([
            'amount'            => $invoice['amount'],
            'tracking_cookie'   => $response->data->tracking_cookie,
            'transaction_id'    => $response->data->transaction_id,
            'invoice_id'        => $invoice->id
        ]);
        $transaction->save();
        return $response->data;
    }





    public function query($id): iterable
    {
        $user = Auth::user();
        $v2rayClient = V2ray()->createClient($user);
        return [
            'v2ray' => json_encode($v2rayClient)
        ];
    }
    public function layout(): iterable{return [];}
}
