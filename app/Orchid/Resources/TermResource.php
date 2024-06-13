<?php

namespace App\Orchid\Resources;

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

class TermResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Term::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('period_time')->horizontal()
                ->title('Period Time')
                ->placeholder('Enter Period Time (only Month)')
                ->required(),

        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('period_time', 'Period Credit'),
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
        return 'Period Time';

    }
    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('period_time'),

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
        return 21;
    }

}
