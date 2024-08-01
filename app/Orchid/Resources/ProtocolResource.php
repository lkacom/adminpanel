<?php

namespace App\Orchid\Resources;

use App\Models\Protocol;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;

class ProtocolResource extends Resource
{

    public static $model = Protocol::class;

    public static function permission(): ?string
    {
        return 'admin.protocols';
    }

    public static function icon(): string
    {
        return 'shield';
    }

    public static function description(): ?string
    {
        return 'Protocol list Available';
    }

    public static function label(): string
    {
        return 'Protocols';

    }

    public static function perPage(): int
    {
        return 30;
    }

    public static function displayInNavigation(): bool
    {
        return false;
    }

    public function filters(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('name')->horizontal()
                ->title('VPN Protocol')
                ->placeholder('Enter Protocol Connection'),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id','Number'),
            TD::make('name','Protocol'),

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
        return [];
    }

}
