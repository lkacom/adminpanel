<?php

namespace App\Orchid\Screens\Client;


use Auth;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class OrderScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.order.new'];
    }

    public function query($id): iterable
    {
        $user = Auth::user();
        $v2rayClient = V2ray()->createClient($user);
        return [
            'v2ray' => json_encode($v2rayClient)
        ];
    }

    public function name(): ?string
    {
        return __('Purchase Order');
    }
    public function description(): ?string
    {
        return __('Product list for new order');
    }

    public function commandBar(): array
    {
        return [

        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::legend('v2ray', [
                Sight::make('Config')->render(fn($v2ray) => $v2ray),
            ])
        ];
    }
}
