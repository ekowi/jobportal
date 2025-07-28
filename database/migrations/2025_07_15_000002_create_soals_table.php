<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id('id_soal');
            $table->unsignedBigInteger('id_kategori_soal');
            $table->text('soal');
            $table->text('pilihan_1');
            $table->text('pilihan_2');
            $table->text('pilihan_3');
            $table->text('pilihan_4');
            $table->unsignedBigInteger('id_kategori_jawaban');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('id_kategori_soal')
                  ->references('id')
                  ->on('kategori_soals')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('soals');
    }
};