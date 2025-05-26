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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->string('category')->nullable();
            $table->string('job_type')->nullable();
            $table->string('applicants_count')->nullable();
            $table->string('country')->nullable();
            $table->string('experience')->nullable();
            $table->string('min_salary')->nullable();
            $table->string('max_salary')->nullable();
            $table->string('created_user')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company logo')->nullable();
            $table->string('address')->nullable();
            $table->string('Description')->nullable();
            $table->string('city')->nullable();
            $table->string('addon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
