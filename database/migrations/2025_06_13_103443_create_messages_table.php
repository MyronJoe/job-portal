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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->text('applicant_id')->nullable();
            $table->text('applicant_name')->nullable();
            $table->text('job_id')->nullable();
            $table->text('company_name')->nullable();
            $table->text('application_id')->nullable();
            $table->text('job_title')->nullable();
            $table->text('company_logo')->nullable();
            $table->text('status')->nullable();
            $table->text('addon1')->nullable();
            $table->text('addon2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
