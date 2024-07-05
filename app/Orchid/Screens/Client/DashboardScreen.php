<?php

namespace App\Orchid\Screens\Client;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DashboardScreen extends Screen
{
    public function __construct()
    {
        addJavascriptFile('assets/plugins/jQuery/3.7.1/jquery-3.7.1.min.js');
        addJavascriptFile('assets/plugins/clipboard.js/2.0.11/dist/clipboard.min.js');
        addJavascriptFile('assets/js/scripts.bundle.js');
        addJavascriptFile('assets/js/copy.js');
    }
    public function permission(): ?iterable
    {
        return ['client.dashboard'];
    }

    public function name(): ?string
    {
        return __('Dashboard');
    }
    public function query(): iterable
    {
        $userEmail = Auth::id();

        $clientServices = Order::query()->where('user_id' , $userEmail)->latest()->limit(1)->get();
        $account = Transaction::query()->where('invoice_id' , $userEmail)->get();
        $paid = Invoice::query()->where('user_id' , $userEmail)->get();

        if (!$clientServices)
            echo "No record found.";

        return [

            'table'   => ($clientServices),

            'metrics' => [
                'paid'      => ['value' => $paid->Where('status' , '1')->count()],
                'active'    => ['value' => $account->count()],
                'expire'    => ['value' => $account->count()],
            ],

        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::metrics([
                __('Paid Account')    => 'metrics.paid',
                __('Active Accounts') => 'metrics.active',
                __('Expired Account') => 'metrics.expire',
            ]),

            Layout::rows([
                Label::make('title')
                    ->title(__('Last Config')),
            ]),

                Layout::tabs([
                    __('Direct Config') => [
                        Layout::table('table', [
                            TD::make('id',__('ID')),
                            TD::make('name',__('Type')),
                            TD::make('expiration_date',__('Expire Date')),
                            TD::make('config',__('Config'))
                                ->popover(__('Click on QR-Code for Copy Config'))
                                ->render(function ($invoice) {
                                    $configURI = $invoice->config;
                                    $QR = DNS2D::getBarcodePNG($configURI, 'QRCODE',2,2);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$configURI' style='cursor: pointer;/>
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }),

                            TD::make('status',__('Status'))
                                ->render(fn (Order $order) => Carbon::now()->lte($order->expiration_date)
                                    ? '<i class="text-danger circle">Expired</i>'
                                    : '<i class="text-success circle">Active</i>'),
                        ]),


                    ],
                    __('Fragment') => [
                        Layout::table('table', [
                            TD::make('id',__('ID')),
                            TD::make('name',__('Type')),
                            TD::make('expiration_date',__('Expire Date')),
                            TD::make('config',__('Config'))
                                ->popover(__('Click on QR-Code for Copy Config'))
                                ->render(function ($invoice) {
                                    $configURI = url('json/'.$invoice->uuid);
                                    $QR = DNS2D::getBarcodePNG($configURI, 'QRCODE',4,4);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$configURI' style='cursor: pointer; />
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }),

                            TD::make('status',__('Status'))
                                ->render(fn (Order $order) => Carbon::now()->lte($order->expiration_date)
                                    ? '<i class="text-danger circle">Expired</i>'
                                    : '<i class="text-success circle">Active</i>'),
                        ]),


                    ],

                    __('Subscription') => [
                        Layout::table('table', [
                            TD::make('id',__('ID')),
                            TD::make('name',__('Type')),
                            TD::make('expiration_date',__('Expire Date')),
                            TD::make('config',__('Config'))
                                ->popover(__('Click on QR-Code for Copy Config'))
                                ->render(function ($invoice) {
                                    $configURI = url('subs/'.$invoice->uuid);
                                    $QR = DNS2D::getBarcodePNG($configURI, 'QRCODE',4,4);
                                    return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$configURI' style='cursor: pointer;/>
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                                }),

                            TD::make('status',__('Status'))
                                ->render(fn (Order $order) => Carbon::now()->lte($order->expiration_date)
                                    ? '<i class="text-danger circle">Expired</i>'
                                    : '<i class="text-success circle">Active</i>'),
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
