<?php

namespace App\Orchid\Resources;

use App\Models\Server;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;

class ServerResource extends Resource
{

    public static $model = Server::class;

    public function show()
    {
        dd('dddd');
    }


    public static function permission(): ?string
    {
        return 'admin.servers';
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
        return 23;
    }

    public static function description(): ?string
    {
        return 'Server list Available';
    }

    public static function icon(): string
    {
        return 'server';
    }

    public function filters(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('name')->horizontal()
                ->title('Location')
                ->placeholder('Enter Country Name'),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id','Number'),
            TD::make('name','Location'),
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

    public function legend(): array
    {
        return [
            Sight::make('id','Number'),
            Sight::make('name','Server'),
        ];
    }

}

