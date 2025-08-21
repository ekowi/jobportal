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
        Schema::create('kandidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('no_telpon')->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('negara')->nullable();
            $table->string('no_ktp')->unique()->nullable();
            $table->string('no_npwp')->unique()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('agama')->nullable();
            $table->string('bmi_score');
            $table->string('blind_score');
            $table->string('no_telpon_alternatif')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('kemampuan_bahasa')->nullable();
            $table->text('kemampuan')->nullable();
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
        Schema::dropIfExists('kandidats');
    }
};
