<?php

namespace App\Orchid\Screens\Client;

use App\Models\Product;
use Auth;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use App\Orchid\Layout;

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
    public function asyncNewOrderModal($product): iterable
    {
        return [
            'product' => $product,
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

    public function layout(): iterable
    {
        return [
            Layout::columns([
                Layout::table('products', [
                    TD::make(__('Product Name'))->render(function ($product) {
                            return "{$product->name} {$product->period->time} {$product->protocol->name} {$product->server->name}";
                        }),
                    TD::make(__('Action'))->render(function ($product) {
                        return Auth::user()->hasAccess('client.order.new')?
                            ModalToggle::make('Buy Now')
                                ->modal('new-order-modal')
                                ->parameters(['product' => $product->id])
                                ->route('client.order', ['new']):'<span class="btn-danger">Order registration is not allowed</span>';
                        }),
                ]),

            ]),

            Layout::modal('new-order-modal', [
                Layout::rows([
                    Input::make('product.id')->hidden(),
                ])->class('hidden'),
                Layout::legend('', [
                    Sight::make('product.name','Product Name:'),
                    Sight::make('product.protocol.name','Protocol:'),
                    Sight::make('product.price','Product Price:'),
                ])->border(false)->class('no-py new-order-modal'),
            ])->async('asyncGetProduct')->applyButton('Buy Now'),
        ];
    }

    public function asyncGetProduct(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }
}
