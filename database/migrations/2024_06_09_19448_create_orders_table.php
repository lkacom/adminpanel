<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('relation_type')->nullable();
            $table->string('relation_id')->nullable();
            $table->json('attributes')->nullable();
            $table->string('description')->nullable();
            $table->integer('quantity')->default(1);
            $table->boolean('renew')->default(true);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
