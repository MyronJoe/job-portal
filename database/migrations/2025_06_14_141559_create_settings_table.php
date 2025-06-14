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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('logo_name')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('phone_no')->nullable();
            $table->text('fave_icon')->nullable();
            $table->text('about')->nullable();
            $table->text('seo')->nullable();
            $table->text('addon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
