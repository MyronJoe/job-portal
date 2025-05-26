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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('cover_later')->nullable();
            $table->string('applicant_id')->nullable();
            $table->string('job_id')->nullable();
            $table->string('job_poster_id')->nullable();
            $table->string('Cv')->nullable();
            $table->string('application_status')->nullable();
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
        Schema::dropIfExists('applications');
    }
};
