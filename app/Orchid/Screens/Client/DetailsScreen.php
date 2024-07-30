<?php

namespace App\Orchid\Screens\Client;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Label;

class DetailsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $userEmail = Auth::id();
        $order = Order::query()->where('user_id', $userEmail)->where('id', request('id'))->get();

        return [
            'table'   => $order,

        ];
    }

    public function __construct()
    {
        addJavascriptFile('assets/plugins/jQuery/3.7.1/jquery-3.7.1.min.js');
        addJavascriptFile('assets/plugins/clipboard.js/2.0.11/dist/clipboard.min.js');
        addJavascriptFile('assets/js/scripts.bundle.js');
        addJavascriptFile('assets/js/copy.js');
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Orders Details');
    }
    public function description(): ?string
    {
        return __('Get Config and Accounts');
    }
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */

    public function layout(): iterable
    {
        return [

            Layout::tabs([
                __('Direct Config') => [
                    Layout::table('table', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $invoice) {
                                return $invoice->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
                            ->popover(__('Click on QR-Code for Copy Config'))
                            ->render(function ($invoice) {
                                $configURI = $invoice->attributes;
                                $QR = DNS2D::getBarcodePNG($configURI, 'QRCODE',2,2);
                                return "
                                <img src='data:image/png;base64,$QR' alt='QRCode' data-action='copy' data-content='$configURI' style='cursor: pointer;/>
                                <span class='copy-result'>
                                    <i class='ki-solid ki-copy fs-2'></i>
                                </span>";
                            }),

                        TD::make('status',__('Status'))
                            ->render(fn (Order $order) => Carbon::now()->lte($order->created_at)
                                ? '<i class="text-danger circle">Expired</i>'
                                : '<i class="text-success circle">Active</i>'),
                    ]),


                ],
                __('Fragment') => [
                    Layout::table('table', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $invoice) {
                                return $invoice->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
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
                            ->render(fn (Order $order) => Carbon::now()->lte($order->created_at)
                                ? '<i class="text-danger circle">Expired</i>'
                                : '<i class="text-success circle">Active</i>'),
                    ]),


                ],

                __('Subscription') => [
                    Layout::table('table', [
                        TD::make('id',__('ID')),
                        TD::make('product_id',__('Product'))
                            ->render(function (Order $invoice) {
                                return $invoice->product->name;
                            }),
                        TD::make('description',__('description')),
                        TD::make('created_at',__('Expire Date')),
                        TD::make('attributes',__('Config'))
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
                            ->render(fn (Order $order) => Carbon::now()->lte($order->created_at)
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

