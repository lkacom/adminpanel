<?php

namespace App\Orchid\Screens\Client;

use App\Models\Product;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ShopScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['client.shop.index'];
    }
    public function query(): iterable
    {
        return [
            'products'   => Product::query()->get(),
        ];
    }

    public function name(): string
    {
        return __('Purchase Order');
    }

    public function description(): string
    {
        return __('Product list for new order');
    }
    public function asyncNewOrder(Product $product): iterable
    {
        return [
            'product' => $product,
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::columns([
                Layout::table('products', [
                    TD::make('id', __('ID'))->sort(),
                    TD::make('VPN_Name', __('Product Name'))->render(function ($product) {
                            return "{$product->VPN_Name} {$product->period->period_time} {$product->protocol->protocol_name} {$product->server->server_name}";
                        }),
                    TD::make('id', __('Action'))->render(function ($product) {
                            return ModalToggle::make('Buy Now')
                                ->modal('new-order-modal')
                                ->modalTitle('Buy '.$product->VPN_Name)
                                ->parameters(['product'=>$product->id]);
                        }),
                ]),
            ]),
            Layout::modal('new-order-modal', [
                Layout::rows([
                    Label::make('product.VPN_Name'),
                    Input::make('product.VPN_Name')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title(__('Name'))
                        ->placeholder(__('Name')),
                ]),
            ])->async('asyncNewOrder')
        ];
    }

}
