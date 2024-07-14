<?php
namespace App\Orchid\Screens\Client;

use Auth;
use Orchid\Screen\Screen;

class OrderScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.order.new'];
    }

    public function new()
    {
        dd(request()->all());
    }

    public function query($id): iterable
    {
        $user = Auth::user();
        $v2rayClient = V2ray()->createClient($user);
        return [
            'v2ray' => json_encode($v2rayClient)
        ];
    }




    public function layout(): iterable
    {
        return [];
    }
}
