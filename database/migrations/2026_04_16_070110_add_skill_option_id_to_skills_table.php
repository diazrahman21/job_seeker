<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('skill_option_id')->nullable()->after('job_seeker_id')->constrained('skill_options')->nullOnDelete();
            $table->unique(['job_seeker_id', 'skill_option_id']);
        });

        DB::statement(
            'UPDATE skills s
             SET skill_option_id = so.id
             FROM skill_options so
             WHERE lower(s.name) = lower(so.name)'
        );
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropUnique('skills_job_seeker_id_skill_option_id_unique');
            $table->dropConstrainedForeignId('skill_option_id');
        });
    }
};
