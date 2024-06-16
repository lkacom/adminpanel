<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->jsonb('permissions')->nullable();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            'id' => '1',
            'slug' => 'admin',
            'name' => 'admin',
            'permissions' => '{"platform.admin": "1", "platform.index": "1", "platform.client": "0", "private-Term-resource": "1", "platform.systems.roles": "1", "platform.systems.users": "1", "private-Server-resource": "1", "private-Product-resource": "1", "private-Protocol-resource": "1", "platform.systems.attachment": "1"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'slug' => 'client',
            'name' => 'client',
            'permissions' => '{"platform.admin": "0", "platform.index": "1", "platform.client": "1", "private-Term-resource": "0", "platform.systems.roles": "0", "platform.systems.users": "0", "private-Server-resource": "0", "private-Product-resource": "0", "private-Protocol-resource": "0", "platform.systems.attachment": "0"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
