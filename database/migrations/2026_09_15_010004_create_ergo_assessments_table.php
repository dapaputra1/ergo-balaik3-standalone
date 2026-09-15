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
    Schema::create('ergo_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('company_id')->constrained('ergo_companies')->onDelete('cascade');
        $table->unsignedBigInteger('surveyor_id'); // Menyimpan ID petugas/user
        $table->string('department'); // Divisi/Bagian yang dinilai
        $table->date('assessment_date');
        $table->enum('status', ['draft', 'submitted', 'approved'])->default('draft');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ergo_assessments');
    }
};
