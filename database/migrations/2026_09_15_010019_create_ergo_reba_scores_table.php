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
    Schema::create('ergo_reba_scores', function (Blueprint $table) {
        $table->id();
        $table->foreignId('worker_id')->constrained('ergo_workers')->onDelete('cascade');
        
        // Group A Scores (Batang tubuh, leher, kaki)
        $table->integer('trunk_score')->default(0);
        $table->integer('neck_score')->default(0);
        $table->integer('leg_score')->default(0);
        $table->integer('load_force_score')->default(0);
        $table->integer('score_a_total')->default(0);
        
        // Group B Scores (Lengan atas, lengan bawah, pergelangan tangan)
        $table->integer('upper_arm_score')->default(0);
        $table->integer('lower_arm_score')->default(0);
        $table->integer('wrist_score')->default(0);
        $table->integer('coupling_score')->default(0);
        $table->integer('score_b_total')->default(0);
        
        // Final Result
        $table->integer('activity_score')->default(0);
        $table->integer('final_score')->default(0);
        $table->string('risk_level')->nullable(); // Misal: Low, Medium, High, Very High
        
        $table->string('photo_path')->nullable(); // Path foto postur kerja
        $table->text('notes')->nullable(); // Rekomendasi / catatan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ergo_reba_scores');
    }
};
