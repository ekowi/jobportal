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
        Schema::create('bmi_tests', function (Blueprint $table) {
            $table->id();
            
            // Kunci asing yang terhubung ke tabel kandidats
            $table->foreignId('kandidat_id')->constrained('kandidats')->onDelete('cascade');

            $table->float('tinggi_badan'); // dalam cm
            $table->float('berat_badan'); // dalam kg
            $table->float('score'); // Hasil skor BMI
            $table->string('kategori'); // Kurus, Normal, Gemuk, Obesitas

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmi_tests');
    }
};