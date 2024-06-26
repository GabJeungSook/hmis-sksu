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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->integer('quantity');
            $table->decimal('sub_total', 8, 2);
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('grand_total', 8, 2);
            $table->decimal('amount_paid', 8, 2)->nullable();
            $table->decimal('change', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
