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
        Schema::table('family_register', function (Blueprint $table) {
            $table->foreignId('state_id')->after('surname');
            $table->foreignId('district_id')->after('state_id');
            $table->foreignId('sub_district_id')->after('district_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_register', function (Blueprint $table) {
            //
        });
    }
};
