<?php

namespace App\Orchid\Resources;

use App\Models\Period;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;

class PeriodResource extends Resource {

    public static $model = Period::class;

    public function onSave(ResourceRequest $request, Model $model)
    {
        $model->fill([
            'duration' => $request->get('duration')
        ])->save();
    }

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
            Input::make('duration')
                ->horizontal()
                ->title('Duration Time')
                ->placeholder('Enter Period Time')
                ->required(),

            Select::make('type')
                ->horizontal()
                ->title('Type')
                ->options([
                    'minute'    => 'Minutes',
                    'hour'      => 'Hours',
                    'day'       => 'Days',
                    'week'      => 'Weeks',
                    'month'     => 'Months',
                    'year'      => 'Years'
                ]),
            ];

    }

    public function columns(): array
    {
        return [
            TD::make('duration', 'Duration'),
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
