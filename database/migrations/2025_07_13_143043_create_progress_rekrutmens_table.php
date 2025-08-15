<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_rekrutmens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamar_lowongan_id')->constrained()->onDelete('cascade');
            $table->foreignId('officer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nama_progress');
            $table->enum('status', ['diterima', 'interview', 'psikotes', 'ditolak'])->default('interview');
            $table->text('catatan')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->boolean('is_interview')->default(false);
            $table->boolean('is_psikotes')->default(false);
            $table->dateTime('waktu_pelaksanaan')->nullable();
            $table->string('user_create')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_rekrutmens');
    }
};
