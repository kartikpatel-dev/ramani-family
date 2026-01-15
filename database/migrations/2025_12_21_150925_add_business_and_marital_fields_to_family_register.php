<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('family_register', function (Blueprint $table) {
            // 🏢 Business detail
            $table->string('business_name')->nullable();
            $table->text('business_address')->nullable();
            $table->string('business_contact')->nullable();
            $table->text('other_detail')->nullable();

            // 💍 Marital detail
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('zodiac')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('brother')->nullable();
            $table->integer('sister')->nullable();
            $table->text('maternal_detail')->nullable();
            $table->text('property_detail')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('family_register', function (Blueprint $table) {
            $table->dropColumn([
                'business_name','business_address','business_contact','other_detail',
                'height','weight','zodiac','education','occupation',
                'brother','sister','maternal_detail','property_detail'
            ]);
        });
    }
};
