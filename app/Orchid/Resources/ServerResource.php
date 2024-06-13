<?php

namespace App\Orchid\Resources;

use App\Models\Server;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;

class ServerResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Server::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('server_name')->horizontal()
                ->title('Location')
                ->placeholder('Enter Country Name'),


        ];
    }

    public static function icon(): string
    {
        return 'server';
    }
    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id','Number'),
            TD::make('server_name','Location'),
            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    public static function description(): ?string
    {
        return 'Server list Avilable';
    }
    public static function label(): string
    {
        return 'Servers Managment';

    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id','Number'),
            Sight::make('server_name','Server'),


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
        return 23;
    }

}

