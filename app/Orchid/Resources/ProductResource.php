<?php

namespace App\Orchid\Resources;

use App\Models\Product;
use App\Models\Protocol;
use App\Models\Server;
use App\Models\Period;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;

class ProductResource extends Resource
{
    public static $model = Product::class;

    public static function permission(): ?string
    {
        return 'admin.products';
    }

    public static function perPage(): int
    {
        return 30;
    }

    public static function displayInNavigation(): bool
    {
        return false;
    }

    public static function sort(): string
    {
        return 40;
    }
    
    public static function description(): ?string
    {
        return 'Product Manager';
    }

    public static function label(): string
    {
        return 'Products';

    }

    public function filters(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [

            Input::make('name')
                ->title('Product Name')
                ->placeholder('Enter product name')
                ->required(),

            Select::make('period_id')
                ->title('Duration')
                ->fromModel(Period::class, 'duration')
                ->required(),

            Select::make('protocol_id')
                ->title('protocol')
                ->fromModel(Protocol::class, 'name')
                ->required(),

            Select::make('server_id')
                ->title('server')
                ->fromModel(Server::class, 'name')
                ->required(),

            Input::make('price')
                ->title('Product Price')
                ->placeholder('Enter product Price in Toman')
                ->type('number')
                ->min(100)
                ->required(),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id', __('ID')),
            TD::make('VPN_Name', __('Name'))
                ->render(function ($model) {
                    return "{$model->VPN_Name} {$model->period->period_time} {$model->protocol->protocol_name} {$model->server->server_name}";
                }),


            TD::make('created_at', __('Date of creation'))
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->defaultHidden()
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('Product Details')
                ->render(function ($model) {
                    return "{$model->VPN_Name} {$model->period->period_time} {$model->protocol->protocol_name} {$model->server->server_name}";
                }),

        ];
    }

}
