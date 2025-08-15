<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('progress_rekrutmen', function (Blueprint $table) {
            $table->string('link_zoom')->nullable()->after('waktu_pelaksanaan');
        });
    }

    public function down()
    {
        Schema::table('progress_rekrutmen', function (Blueprint $table) {
            $table->dropColumn('link_zoom');
        });
    }
};