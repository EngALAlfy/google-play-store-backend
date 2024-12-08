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
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->nullable()->constrained('users');
            $table->foreignId('account_id')->nullable()->constrained();
            $table->foreignId('broker_id')->nullable()->constrained('users');
            $table->float('total_price');
            $table->text('description')->nullable();
            $table->string('photo', 2048)->nullable();
            $table->string('website', 255)->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
