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
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('cover_later')->nullable();
            $table->string('applicant_id')->nullable();
            $table->string('job_id')->nullable();
            $table->string('job_poster_id')->nullable();
            $table->string('Cv')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_title')->nullable();
            $table->string('address')->nullable();
            $table->string('min_salary')->nullable();
            $table->string('max_salary')->nullable();
            $table->string('company_name')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('category')->nullable();
            $table->string('experience')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('addon1')->nullable();
            $table->string('addon2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};
