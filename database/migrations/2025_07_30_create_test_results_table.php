<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('total_questions');
            $table->integer('correct_answers')->default(0);
            $table->decimal('score', 5, 2)->default(0.00);
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('test_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_result_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('soal_id');
            $table->foreign('soal_id')->references('id_soal')->on('soals');
            $table->string('user_answer')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_answers');
        Schema::dropIfExists('test_results');
    }
};