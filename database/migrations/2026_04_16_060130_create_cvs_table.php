<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->string('file_name')->nullable();
            $table->timestamps();

            $table->unique(['job_seeker_id', 'media_id']);
        });

        DB::statement(
            "INSERT INTO cvs (job_seeker_id, media_id, file_name, created_at, updated_at)
             SELECT js.id, m.id, m.file_name, NOW(), NOW()
             FROM media m
             INNER JOIN users u ON u.id = m.model_id AND m.model_type = 'App\\\\Models\\\\User' AND m.collection_name = 'cvs'
             INNER JOIN job_seekers js ON js.user_id = u.id"
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
