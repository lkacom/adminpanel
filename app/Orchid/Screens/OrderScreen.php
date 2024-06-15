<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrderScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        $product = Product::query()->get();

        return [

            'table'   => ($product),


        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Product';
    }
    public function description(): ?string
    {
        return 'Product list for new order';
    }
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [

            Layout::columns([
                Layout::table('table', [
                    TD::make('id', 'ID')->sort(),
                    TD::make('VPN_Name', __('Product Name'))
                        ->render(function ($model) {
                            return "{$model->VPN_Name} {$model->term->period_time} {$model->protocol->protocol_name} {$model->server->server_name}";
                        }),
                    TD::make('action', 'Action')
                        ->render(function ($product) {
                            return Link::make('Order Now')
                                ->href('/buy/' . $product['id'])
                                ->icon('basket');
                        }),
                ]),
            ]),

        ];
    }
}
