<?php

namespace Database\Seeders;

use App\Models\User;
use Orchid\Platform\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'email_verified_at' => now(),
            'verification_code'=>'11111',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => [
                "platform.index"    => 1,
                "admin.roles.menu"  => 1,
                "admin.roles"       => 1,
                "admin.users.menu"  => 1,
                "admin.users"       => 1,
                "admin.periods"       => 1,
                "admin.servers"       => 1,
                "admin.servers.menu"       => 1,
                "admin.invoices"       => 1,
                "admin.invoices.menu"       => 1,
                "admin.products"       => 1,
                "admin.products.menu"       => 1,
                "admin.dashboard"       => 1,
                "admin.dashboard.menu"       => 1,
                "admin.protocols"       => 1,
                "admin.protocols.menu"       => 1,
                "admin.logout.menu"       => 1,
                "admin.admin.transactions"       => 1,
                "admin.transactions.menu"       => 1,
                "platform.systems.attachment"       => 1,
                "client.dashboard"       => 0,
                "client.order.new"       => 0,
                "client.shop.menu"       => 0,
                "client.shop.index"       => 0,
                "client.logout.menu"       => 0,
                "client.orders.menu"       => 0,
                "client.orders.index"       => 0,
                "client.orders.renew"       => 0,
                "client.profile.menu"       => 0,
                "client.invoices.menu"       => 0,
                "client.profile.index"       => 0,
                "client.dashboard.menu"       => 0,
                "client.invoices.index"       => 0,
                "client.profile.update"       => 0,
                ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'slug'  => 'client',
            'name'  => 'Client',
            'permissions' => [
                "platform.index"    => 1,
                "client.dashboard"       => 1,
                "client.order.new"       => 1,
                "client.shop.menu"       => 1,
                "client.shop.index"       => 1,
                "client.logout.menu"       => 1,
                "client.orders.menu"       => 1,
                "client.orders.index"       => 1,
                "client.orders.renew"       => 1,
                "client.profile.menu"       => 1,
                "client.invoices.menu"       => 1,
                "client.profile.index"       => 1,
                "client.dashboard.menu"       => 1,
                "client.invoices.index"       => 1,
                "client.profile.update"       => 1,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::where('email','admin@admin.com')->first()->addRole(
            Role::where('name','admin')->get()->first()
        );
    }
}
