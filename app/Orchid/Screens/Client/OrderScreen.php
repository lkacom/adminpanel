<?php
namespace App\Orchid\Screens\Client;

use App\Models\Invoice;
use App\Models\Product;
use Auth;
use Illuminate\Support\Arr;
use Orchid\Screen\Screen;

class OrderScreen extends Screen
{

    public array $productsToBuy = [];

    public function permission(): ?iterable
    {
        return ['client.order.new'];
    }

    public function new()
    {
        if(Auth::user()->hasAccess('client.order.new')){
            $products = Product::find(request()->only('product'));
            $this->createPurchase($products);
        }
        else abort(403);
    }

    protected function createPurchase($products)
    {
        $invoice = $this->creteInvoice($products);

        if (request()->ajax()) {
            return $invoice;
        }
        else{
            $data = json_decode($invoice,true)['data'];
            return view('redirectForm')->with(
                [
                    'action' => $data['payment_url'],
                    'inputs' => Arr::only($data, ['transaction_id', 'tracking_cookie']),
                    'method' => 'POST',
                ]
            );
        }
    }

    protected function creteInvoice($products)
    {
        $this->prepareProductsForInvoice($products);
        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'amount' => 0,
        ]);
dd($invoice);
        $invoice = $invoice->load('items');

        if ($invoice->price === 0) {
            return createV2rayClient($this->user);
        } else {
            //Create TransactionId
            return $this->createTransaction($invoice);
            //$invoice->tracking_id = $invoice->trackingId->id;
        }

        //$response = compact('invoice', 'transaction');
        //return response()->success($response, 200, 'Invoice & bank transaction created.');

    }

    protected function prepareProductsForInvoice( $products)
    {
        return $products->each(function ($item) {
            return $this->productsToBuy[$item->id] = 1;
        });
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
