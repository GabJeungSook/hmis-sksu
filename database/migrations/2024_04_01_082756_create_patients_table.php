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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable()->onDelete('cascade');
            $table->foreignId('bed_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->date('birth_date')->nullable();
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('guardian_name')->nullable();
            $table->text('initial_diagnosis')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
