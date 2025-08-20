<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kandidats', function (Blueprint $table) {
            // Drop old single-text fields
            $table->dropColumn(['pengalaman_kerja', 'pendidikan', 'kemampuan_bahasa']);
            // New JSON columns for detailed sections
            $table->json('work_experiences')->nullable();
            $table->json('education_history')->nullable();
            $table->json('language_skills')->nullable();
            // Specific information fields
            $table->boolean('worked_before')->nullable();
            $table->string('previous_work_location')->nullable();
            $table->string('job_info_source')->nullable();
            $table->string('gender_identity')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kandidats', function (Blueprint $table) {
            $table->dropColumn([
                'work_experiences',
                'education_history',
                'language_skills',
                'worked_before',
                'previous_work_location',
                'job_info_source',
                'gender_identity',
            ]);
            // Re-add original columns
            $table->text('pengalaman_kerja')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('kemampuan_bahasa')->nullable();
        });
    }
};
