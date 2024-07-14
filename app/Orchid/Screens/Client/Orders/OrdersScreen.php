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
        $userEmail = Auth::id();
        dd($userEmail);
        $orders = Order::query()->where('user_id' , $userEmail)->filters()->defaultSort('id')->paginate(4);

        return [
            'table'   => ($orders),
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
                Layout::table('table', [

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
                        ->sort(),

                    TD::make('config',__('Config'))
                        ->render(function ($invoice) {
                            $QR = DNS2D::getBarcodePNG(url('qr/'.$invoice->uuid), 'QRCODE',4.55,4.55);
                            return "<img src='data:image/png;base64,$QR'/>";
                        }),

                    TD::make('status',__('Status'))
                        ->render(fn (Order $user) => Carbon::now()->lte($user->expiration_date)
                            ? '<i class="text-success circle">Active</i>'
                            : '<i class="text-danger circle">Expired</i>'
                        ),
                ]),
            ]),
        ];
    }
}
