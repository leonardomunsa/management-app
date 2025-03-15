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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->text('details');
            $table->bigInteger('amount');
            $table->boolean('paid')->default(false);
            $table->bigInteger('order_number')->nullable()->default(null);
            $table->foreign('order_number')->references('number')->on('orders')->onDelete('cascade');
            $table->uuid('client_uuid');
            $table->foreign('client_uuid')->references('uuid')->on('clients')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
