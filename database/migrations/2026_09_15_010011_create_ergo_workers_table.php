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
    Schema::create('ergo_workers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assessment_id')->constrained('ergo_assessments')->onDelete('cascade');
        $table->string('name'); // Nama / Inisial Pekerja
        $table->integer('age')->nullable();
        $table->enum('gender', ['L', 'P'])->nullable();
        $table->integer('working_years')->nullable(); // Masa kerja (tahun)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ergo_workers');
    }
};
