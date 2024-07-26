<?php
namespace App\Orchid;

use App\Orchid\Resources\PeriodResource;
use App\Orchid\Resources\ProductResource;
use App\Orchid\Resources\ProtocolResource;
use App\Orchid\Resources\ServerResource;
use Auth;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{


    public function menu(): array
    {
        return [

            // Admin menu
            Auth::user()->hasAnyAccess('admin.*.menu')?
                Menu::make()
                    ->active('*')
                    ->slug('admin-menu')
                    ->title('Admin Menu')
                    ->list([
                        Menu::make('Dashboard')
                            ->icon('bs.book')
                            ->permission('admin.dashboard.menu')
                            ->route('admin.dashboard'),

                        Menu::make('Invoices')
                            ->icon('task')
                            ->permission('admin.invoices.menu')
                            ->route('admin.invoices'),

                        Menu::make('Transactions')
                            ->icon('money')
                            ->permission('admin.transactions.menu')
                            ->route('admin.transactions'),

                        Menu::make(__('Users'))
                            ->icon('bs.people')
                            ->permission('admin.users.menu')
                            ->route('admin.users'),

                        Menu::make(__('Roles'))
                            ->icon('bs.shield')
                            ->permission('admin.roles.menu')
                            ->route('admin.roles'),

                        Menu::make(__('Protocols'))
                            ->icon('shield')
                            ->permission('admin.protocols.menu')
                            ->route('platform.resource.list', [ProtocolResource::uriKey()]),

                        Menu::make(__('Periods'))
                            ->icon('speedometer')
                            ->permission('admin.periods.menu')
                            ->route('platform.resource.list', [PeriodResource::uriKey()]),

                        Menu::make(__('Servers'))
                            ->icon('server')
                            ->permission('admin.servers.menu')
                            ->route('platform.resource.list', [ServerResource::uriKey()]),

                        Menu::make(__('Products'))
                            ->icon('handbag')
                            ->permission('admin.products.menu')
                            ->route('platform.resource.list', [ProductResource::uriKey()]),

                        Menu::make('')
                            ->icon('bs.box-arrow-left')
                            ->permission('admin.logout.menu')
                            ->addBeforeRender(function (){
                                echo Button::make(__('Logout'))
                                    ->confirm('Do you really want to leave the panel? are you sure?<br>If yes, click on Logout button')
                                    ->class('btn btn-default btn-block p-3 no-border no-bg text-white logout-from-menu')
                                    ->icon('bs.box-arrow-left')
                                    ->route('platform.logout');
                            }),
                    ]):
                    Menu::make(),

            // Client Menu
            Auth::user()->hasAnyAccess('client.*.menu')?
                Menu::make()
                    ->active('*')
                    ->slug('client-menu')
                    ->title('Client Menu')
                    ->list([
                        Menu::make(__('Dashboard'))
                            ->icon('bs.book')
                            ->permission('client.dashboard.menu')
                            ->route('client.dashboard'),

                        Menu::make(__('My Orders'))
                            ->icon('credit-card')
                            ->permission('client.orders.menu')
                            ->route('client.orders'),

                        Menu::make(__('Shop'))
                            ->icon('basket')
                            ->permission('client.shop.menu')
                            ->route('client.shop'),

                        Menu::make(__('My Invoices'))
                            ->icon('calculator')
                            ->permission('client.invoices.menu')
                            ->route('client.invoices'),

                        Menu::make(__('Profile'))
                            ->icon('user')
                            ->permission('client.profile.menu')
                            ->route('client.profile'),

                        Menu::make('')
                            ->icon('bs.box-arrow-left')
                            ->permission('client.logout.menu')
                            ->addBeforeRender(function (){
                                echo Button::make(__('Logout'))
                                    ->confirm('Do you really want to leave the panel? are you sure?<br>If yes, click on Logout button')
                                    ->class('btn btn-default btn-block no-border no-bg text-white logout-from-menu')
                                    ->icon('bs.box-arrow-left')
                                    ->route('platform.logout');
                        }),
                    ])
                    :Menu::make()
        ];
    }

    public function permissions(): array
    {
        return [

            // Client Permissions - Begin
            ItemPermission::group(__('Client Menu Access'))
                ->addPermission('client.dashboard.menu' , 'Dashboard')
                ->addPermission('client.shop.menu'      , 'Shop')
                ->addPermission('client.orders.menu'    , 'Orders')
                ->addPermission('client.invoices.menu'  , 'Invoices')
                ->addPermission('client.profile.menu'   , 'Profile')
                ->addPermission('client.logout.menu'    , 'Logout'),

            ItemPermission::group(__('Client Resource Access'))
                ->addPermission('client.dashboard'      , 'dashboard.index')
                ->addPermission('client.shop.index'     , 'shop.index')
                ->addPermission('client.orders.index'   , 'orders.index')
                ->addPermission('client.order.new'      , 'order.new')
                ->addPermission('client.orders.renew'   , 'orders.renew')
                ->addPermission('client.invoices.index' , 'invoices.index')
                ->addPermission('client.invoices.show'  , 'invoices.show')
                ->addPermission('client.profile.index'  , 'profile.index')
                ->addPermission('client.profile.update' , 'profile.update'),
            // Client Permissions - End

            // Admin Permissions - Begin
            ItemPermission::group(__('Admin Menu Access'))
                ->addPermission('admin.dashboard.menu'      , __('Dashboard'))
                ->addPermission('admin.invoices.menu'       , __('Invoices'))
                ->addPermission('admin.transactions.menu'   , __('Transactions'))
                ->addPermission('admin.roles.menu'          , __('Roles'))
                ->addPermission('admin.users.menu'          , __('Users'))
                ->addPermission('admin.products.menu'       , __('Products'))
                ->addPermission('admin.servers.menu'        , __('Servers'))
                ->addPermission('admin.periods.menu'        , __('Periods'))
                ->addPermission('admin.protocols.menu'      , __('Protocols'))
                ->addPermission('admin.logout.menu'         , __('Logout')),

            ItemPermission::group(__('Admin Resource Access'))
                ->addPermission('admin.dashboard'       , __('Dashboard'))
                ->addPermission('admin.invoices'        , __('Invoices'))
                ->addPermission('admin.transactions'    , __('Transactions'))
                ->addPermission('admin.roles'           , __('Roles'))
                ->addPermission('admin.users'           , __('Users')),
            // Admin Permissions - End
        ];
    }
}
