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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('nik')->unique();
            $table->string('jabatan');
            $table->foreignId('atasan_id')->constrained('officers')->onDelete('cascade');
            $table->date('doh');
            $table->string('lokasi_penugasan');
            $table->string('area');
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
        Schema::dropIfExists('officers');
    }
};
