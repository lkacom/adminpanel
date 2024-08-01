<?php
namespace App\Orchid\Screens\Client\Orders;

use App\Models\Account;
use QRCode;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrdersRenewScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.orders.renew'];
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        $userEmail = Auth::id();
        $myService = Account::query()->where('user_id' , $userEmail);

        return [
            'table'   => ($myService),
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
        return [];
    }
}
