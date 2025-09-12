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
        Schema::table('kandidats', function (Blueprint $table) {
            $table->string('ktp_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->string('sertifikat_path')->nullable();
            $table->string('surat_pengalaman_path')->nullable();
            $table->string('skck_path')->nullable();
            $table->string('surat_sehat_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kandidats', function (Blueprint $table) {
            $table->dropColumn([
                'ktp_path',
                'ijazah_path',
                'sertifikat_path',
                'surat_pengalaman_path',
                'skck_path',
                'surat_sehat_path',
            ]);
        });
    }
};
