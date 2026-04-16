<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->foreignId('job_seeker_id')->nullable()->after('user_id')->constrained('job_seekers')->nullOnDelete();
        });

        Schema::table('educations', function (Blueprint $table) {
            $table->foreignId('job_seeker_id')->nullable()->after('user_id')->constrained('job_seekers')->nullOnDelete();
        });

        DB::statement(
            'UPDATE experiences e
             SET job_seeker_id = js.id
             FROM job_seekers js
             WHERE js.user_id = e.user_id'
        );

        DB::statement(
            'UPDATE educations ed
             SET job_seeker_id = js.id
             FROM job_seekers js
             WHERE js.user_id = ed.user_id'
        );
    }

    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropConstrainedForeignId('job_seeker_id');
        });

        Schema::table('educations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('job_seeker_id');
        });
    }
};
