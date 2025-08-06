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
        Schema::create('blind_tests', function (Blueprint $table) {
            $table->id();

            // Kunci asing yang terhubung ke tabel kandidats
            $table->foreignId('kandidat_id')->constrained('kandidats')->onDelete('cascade');

            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->float('score'); // Hasil skor akhir (persentase)
            $table->json('details')->nullable(); // Untuk menyimpan detail jawaban user per soal

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blind_tests');
    }
};