<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ergo_workers', function (Blueprint $table) {
            $table->string('company_type')->nullable();
            $table->string('position')->nullable();
            $table->text('job_tasks')->nullable();
            $table->string('job_duration')->nullable();
            $table->string('dominant_hand')->nullable();
            $table->string('work_duration_level')->nullable();
            $table->string('mental_fatigue')->nullable();
            $table->string('physical_fatigue')->nullable();
            $table->boolean('has_pain_last_year')->default(false);
            $table->json('body_complaints')->nullable();
            $table->json('injury_history')->nullable();
            $table->string('sampler_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('ergo_workers', function (Blueprint $table) {
            $table->dropColumn([
                'company_type',
                'position',
                'job_tasks',
                'job_duration',
                'dominant_hand',
                'work_duration_level',
                'mental_fatigue',
                'physical_fatigue',
                'has_pain_last_year',
                'body_complaints',
                'injury_history',
                'sampler_name',
            ]);
        });
    }
};