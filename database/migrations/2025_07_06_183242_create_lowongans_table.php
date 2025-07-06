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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_lowongan_id')->constrained('kategori_lowongans')->onDelete('cascade');
            $table->string('nama_posisi');
            $table->string('departemen');
            $table->string('lokasi_penugasan');
            $table->boolean('is_remote')->default(false);
            $table->date('tanggal_posting');
            $table->date('tanggal_berakhir')->nullable();
            $table->string('foto');
            $table->text('deskripsi');
            $table->string('range_gaji')->nullable();
            $table->text('kemampuan_yang_dibutuhkan')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->foreignId('user_create')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_update')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
