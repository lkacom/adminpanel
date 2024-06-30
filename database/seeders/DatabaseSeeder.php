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
                "admin.roles"       => 1,
                "admin.users"       => 1,
                ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'slug'  => 'client',
            'name'  => 'Client',
            'permissions' => [
                "platform.index"    => 1,
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::where('email','admin@admin.com')->first()->addRole(
            Role::where('name','admin')->get()->first()
        );
    }
}
