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
        Schema::create('family_register', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->string('village')->nullable();
            $table->text('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->boolean('show_number')->default(true);
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('last_donated')->nullable();
            $table->string('blood_group')->nullable();
            $table->boolean('donate_blood')->default(true);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_register');
    }
};
