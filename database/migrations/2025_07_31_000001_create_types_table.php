<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        // Add type columns to soals table
        Schema::table('soals', function (Blueprint $table) {
            $table->unsignedBigInteger('type_soal_id')->after('id_kategori_soal')->default(1);
            $table->unsignedBigInteger('type_jawaban_id')->after('type_soal_id')->default(1);
            
            $table->foreign('type_soal_id')->references('id')->on('types');
            $table->foreign('type_jawaban_id')->references('id')->on('types');
        });
    }

    public function down()
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropForeign(['type_soal_id']);
            $table->dropForeign(['type_jawaban_id']);
            $table->dropColumn(['type_soal_id', 'type_jawaban_id']);
        });
        
        Schema::dropIfExists('types');
    }
};