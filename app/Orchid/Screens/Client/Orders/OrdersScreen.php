<?php
namespace App\Orchid\Screens\Client\Orders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DNS2D;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrdersScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.orders.index'];
    }

    public function query(): iterable
    {
        $user = Auth::user();

        return [
            'orders'   => $user->orders,
        ];
    }

    public function name(): ?string
    {
        return __('My Orders');
    }
    public function description(): ?string
    {
        return __('List orders');
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::columns([

                Layout::table('orders', [

                    TD::make('id',__('ID'))
                        ->filter(Input::make())
                        ->sort(),

                    TD::make('user_id',__('Email'))
                        ->render(function (Order $invoice) {
                            return $invoice->user->email;
                        })
                        ->sort()
                        ->filter(Input::make()),

                    TD::make('name',__('Type'))
                        ->filter(Input::make())
                        ->sort(),

                    TD::make('expiration_date',__('Expire Date'))
                        ->filter(Input::make())
                        ->render(function (Order $order) {
                            if($order->attributes){
                                return Carbon::make(json_decode($order->attributes)->expiryTime)->setTimezone('Asia/Tehran')->format('Y-m-d H:i:s e');
                            }
                            return '';
                        })
                        ->sort(),

                    TD::make('config',__('Config'))
                        ->render(function (Order $order) {
                            if($order->attributes){
                                $QR = DNS2D::getBarcodePNG(url('qr/' . $order->uuid), 'QRCODE', 4.55, 4.55);
                                return "<img src='data:image/png;base64,$QR'/>";
                            }
                            return '';
                        }),

                    TD::make('status',__('Status'))
                        ->render(function (Order $order) {
                            if($order->attributes){
                                return Carbon::now()->lte(json_decode($order->attributes)->expiryTime)
                                    ? '<i class="text-success circle">Active</i>'
                                    : '<i class="text-danger circle">Expired</i>';
                            }
                            return '<i class="text-warning circle">Pending</i>';
                        }),
                ]),
            ]),
        ];
    }
}
