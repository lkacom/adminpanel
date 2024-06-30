<?php

namespace App\Orchid\Resources;

use App\Models\Period;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;

class PeriodResource extends Resource {

    public static $model = Period::class;

    public static function permission(): ?string
    {
        return 'admin.periods';
    }

    public static function icon(): string
    {
        return 'speedometer';
    }

    public static function description(): ?string
    {
        return 'Period Time Manager';
    }

    public static function label(): string
    {
        return 'Periods';
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
        return 21;
    }

    public function fields(): array
    {
        return [
            Input::make('period_time')->horizontal()
                ->title('Period Time')
                ->placeholder('Enter Period Time (only Month)')
                ->required(),
            ];
    }

    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('period_time', 'Period credit'),
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
            Sight::make('id'),
            Sight::make('period_time'),
        ];
    }

}
