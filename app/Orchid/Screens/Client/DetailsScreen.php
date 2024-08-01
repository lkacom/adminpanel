<?php

namespace App\Orchid\Screens\Client;

use App\Models\Order;
use Carbon\Carbon;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Label;

class DetailsScreen extends Screen
{
    public function query(): iterable
    {
        $userEmail = Auth::id();
        $order = Order::query()->where('user_id', $userEmail)->where('id', request('id'))->get();

        return [
            'order'   => $order,

        ];
    }

    public function __construct()
    {
        addJavascriptFile('assets/plugins/jQuery/3.7.1/jquery-3.7.1.min.js');
        addJavascriptFile('assets/plugins/clipboard.js/2.0.11/dist/clipboard.min.js');
        addJavascriptFile('assets/js/scripts.bundle.js');
        addJavascriptFile('assets/js/copy.js');
    }

    public function name(): ?string
    {
        return __('Orders Details');
    }
    public function description(): ?string
    {
        return __('Get Config and Accounts');
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [

            Layout::tabs([
                __('Direct Config') => [
                    Layout::table('order', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $order) {
                                return $order->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
                            ->popover(__('Click on QR-Code for Copy Config'))
                            ->render(function ($order) {
                                if($order->attributes){
                                    $direct = json_decode($order->attributes)->direct;
                                    $QR = DNS2D::getBarcodePNG($direct, 'QRCODE',2,2);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$direct' style='cursor: pointer;/>
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }
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


                ],
                __('Fragment') => [
                    Layout::table('order', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $order) {
                                return $order->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
                            ->popover(__('Click on QR-Code for Copy Config'))
                            ->render(function ($order) {
                                if($order->attributes){
                                    $fragment = json_encode(json_decode($order->attributes)->fragment);
                                    $QR = DNS2D::getBarcodePNG($fragment, 'QRCODE',4,4);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$fragment' style='cursor: pointer; />
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }
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


                ],

                __('Subscription') => [
                    Layout::table('order', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $order) {
                                return $order->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
                            ->popover(__('Click on QR-Code for Copy Config'))
                            ->render(function ($order) {
                                if($order->attributes){
                                    $subscription = json_decode($order->attributes)->subscription;
                                    $QR = DNS2D::getBarcodePNG($subscription, 'QRCODE',4,4);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$subscription' style='cursor: pointer;/>
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }
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


                ],

            ]),

            Layout::rows([
                Label::make('title')
                    ->title(__('Note: For Copy config to clipboard please click on QRCode ')),
            ]),




        ];
    }

}

