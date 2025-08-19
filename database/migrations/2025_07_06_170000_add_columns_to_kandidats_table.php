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
            $table->string('kota')->nullable()->after('alamat');
            $table->string('pernah_bekerja')->nullable()->after('kemampuan');
            $table->string('lokasi_bekerja')->nullable()->after('pernah_bekerja');
            $table->string('sumber_informasi')->nullable()->after('lokasi_bekerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kandidats', function (Blueprint $table) {
            $table->dropColumn(['kota', 'pernah_bekerja', 'lokasi_bekerja', 'sumber_informasi']);
        });
    }
};
