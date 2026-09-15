<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ergo_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('sector')->nullable();
            $table->timestamps();
        });

        Schema::create('ergo_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('ergo_companies')->onDelete('cascade');
            $table->string('lhu_number')->nullable(); // No Dokumen Pengujian LHU
            $table->string('pic_name')->nullable();    // Penanggung Jawab / Pengurus
            $table->unsignedBigInteger('surveyor_id');
            $table->string('department');
            $table->date('assessment_date');
            $table->enum('status', ['draft', 'submitted', 'approved'])->default('draft');
            $table->timestamps();
        });

        Schema::create('ergo_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('ergo_assessments')->onDelete('cascade');
            $table->string('name');
            $table->integer('age')->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->integer('working_years')->nullable();
            $table->timestamps();
        });

        Schema::create('ergo_reba_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('ergo_workers')->onDelete('cascade');
            
            // Parameter Daftar Periksa SNI 9011:2021
            $table->integer('upper_body_score')->default(0); // Tubuh Bagian Atas
            $table->integer('lower_body_score')->default(0); // Punggung & Tubuh Bawah
            $table->integer('mmh_score')->default(0);        // Manual Material Handling
            
            // Hasil Penilaian & Interpretasi
            $table->integer('final_score')->default(0);
            $table->string('risk_level')->nullable();        // Aman / Perlu Pengamatan / Berbahaya
            
            $table->string('photo_path')->nullable();        // Foto Bukti Postur Kerja
            $table->text('notes')->nullable();               // Catatan & Rekomendasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ergo_reba_scores');
        Schema::dropIfExists('ergo_workers');
        Schema::dropIfExists('ergo_assessments');
        Schema::dropIfExists('ergo_companies');
    }
};