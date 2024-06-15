<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [

            Menu::make('Dashboard')
                ->icon('bs.book')
                ->route('platform.report'),

            Menu::make('Invoice')
                ->icon('task')
                ->route('platform.invoice'),

            Menu::make('Transactions')
                ->icon('money')
                ->route('platform.payment'),
            //user menu
            Menu::make(__('Dashboard'))
                ->icon('bs.book')
                ->title(__('Main Menu'))
                ->permission('platform.client')
                ->route('platform.client.dashboard'),

            Menu::make(__('My Services'))
                ->icon('credit-card')
                ->permission('platform.client')
                ->route('platform.client.myservice'),

            Menu::make(__('My Invoice'))
                ->icon('calculator')
                ->permission('platform.client')
                ->route('platform.client.myinvoice'),

            Menu::make(__('New Order'))
                ->icon('basket')
                ->permission('platform.client')
                ->route('platform.client.order'),


            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            //Client Menu


        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('Client Menu'))
                ->addPermission('platform.client', __('User Access Only')),
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),

        ];
    }
}
