<?php
namespace App\Orchid\Screens\Client\Orders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DNS2D;
use Orchid\Screen\Actions\Link;
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
        //dd($userEmail);
        $orders = Order::query()->where('user_id' , $userEmail)->filters()->defaultSort('id')->paginate(4);

        return [
            'table'   => ($orders),
            'orders' => Order::filters()->defaultSort('id')->paginate(10),
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

                    TD::make('product_id',__('Product'))
                        ->render(function (Order $invoice) {
                            return $invoice->product->name;
                        })
                        ->sort()
                        ->filter(Input::make()),

                    TD::make('created_at',__('Order Date'))
                        ->filter(Input::make())
                        ->sort(),

        TD::make('expiration_date',__('Expire Date'))
                        ->filter(Input::make())
                        ->sort(),

                    TD::make('status',__('Status'))
                        ->render(fn (Order $user) => Carbon::now()->lte($user->created_at)
                            ? '<i class="text-success circle">Active</i>'
                            : '<i class="text-danger circle">Expired</i>'
                        ),

                    TD::make(__('Actions'))
                        ->render(function (Order $invoice) {
                            return Link::make(__('Details'))
                                ->route('client.detail', $invoice->id)
                                ->icon('eye');
                        }),

                ]),
            ]),
        ];
    }
}
