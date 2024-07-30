<?php

declare(strict_types=1);


use App\Orchid\Screens\Admin\InvoiceScreen;
use App\Orchid\Screens\Admin\TransactionScreen;
use App\Orchid\Screens\Admin\DashboardScreen as AdminDashboardScreen;
use App\Orchid\Screens\Admin\Role\RoleEditScreen;
use App\Orchid\Screens\Admin\Role\RoleListScreen;
use App\Orchid\Screens\Admin\User\UserEditScreen;
use App\Orchid\Screens\Admin\User\UserListScreen;
use App\Orchid\Screens\Client\DashboardScreen as ClientDashboardScreen;
use App\Orchid\Screens\Client\DetailsScreen;
use App\Orchid\Screens\Client\InvoicesScreen as ClientInvoicesScreen;
use App\Orchid\Screens\Client\Orders\OrdersScreen;
use App\Orchid\Screens\Client\OrderScreen;
use App\Orchid\Screens\Client\ProfileScreen;
use App\Orchid\Screens\Client\ShopScreen;
use App\Orchid\Screens\MainScreen;
use App\Orchid\Screens\SettingsScreen;
use Illuminate\Support\Facades\Route;

Route::screen('home', MainScreen::class)->name('panel.home');

Route::group(['prefix' => 'admin'], function () {
    Route::screen('dashboard'           , AdminDashboardScreen::class)  ->name('admin.dashboard');
    Route::screen('users'               , UserListScreen::class)        ->name('admin.users');
    Route::screen('users/{user}/edit'   , UserEditScreen::class)        ->name('admin.users.edit');
    Route::screen('users/create'        , UserEditScreen::class)        ->name('admin.users.create');
    Route::screen('roles'               , RoleListScreen::class)        ->name('admin.roles');
    Route::screen('roles/{role}/edit'   , RoleEditScreen::class)        ->name('admin.roles.edit');
    Route::screen('roles/create'        , RoleEditScreen::class)        ->name('admin.roles.create');
    Route::screen('invoices'            , InvoiceScreen::class)         ->name('admin.invoices');
    Route::screen('transactions'        , TransactionScreen::class)     ->name('admin.transactions');
});

Route::group(['prefix' => 'client'], function (){
    Route::middleware(['verified'])->group(function () {
        Route::screen('profile'             , ProfileScreen::class)         ->name('client.profile');
        Route::screen('dashboard'           , ClientDashboardScreen::class) ->name('client.dashboard');
        Route::screen('shop'                , ShopScreen::class)            ->name('client.shop');
        Route::screen('order-history'       , OrdersScreen::class)          ->name('client.orders');
        Route::screen('order'               , OrderScreen::class)           ->name('client.order');
        Route::screen('invoices'            , ClientInvoicesScreen::class)  ->name('client.invoices');
        Route::screen('Details/{id}'             , DetailsScreen::class)  ->name('client.detail');
    });
});


