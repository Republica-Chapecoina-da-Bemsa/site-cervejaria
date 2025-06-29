<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending'); // e.g., pending, completed
            $table->json('products')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipts');
    }
};
