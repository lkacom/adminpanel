<?php

namespace App\Orchid\Resources;

use App\Models\Product;
use App\Models\Protocol;
use App\Models\Server;
use App\Models\Term;
use Orchid\Crud\Resource;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Crud\ResourceRequest;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [

            Input::make('VPN_Name')
                ->title('Product Name')
                ->placeholder('Enter product name')
                ->required(),

            Select::make('term_id')
                ->title('Period Time')
                ->fromModel(Term::class, 'period_time')
                ->required(),

            Select::make('protocol_id')
                ->title('protocol')
                ->fromModel(Protocol::class, 'protocol_name')
                ->required(),

            Select::make('server_id')
                ->title('server')
                ->fromModel(Server::class, 'server_name')
                ->required(),
        ];
    }

    public static function icon(): string
    {
        return 'handbag';
    }
    public static function description(): ?string
    {
        return 'Product Manager';
    }
    public static function label(): string
    {
        return 'Add Product';

    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID')),
            TD::make('VPN_Name', __('Name'))
                ->render(function ($model) {
                    return "{$model->VPN_Name} {$model->term->period_time} {$model->protocol->protocol_name} {$model->server->server_name}";
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

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('Product Details')
                ->render(function ($model) {
                    return "{$model->VPN_Name} {$model->term->period_time} {$model->protocol->protocol_name} {$model->server->server_name}";
                }),

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }


    public static function perPage(): int
    {
        return 30;
    }

    public static function displayInNavigation(): bool
    {
        return true;
    }

    public static function sort(): string
    {
        return 40;
    }


}
