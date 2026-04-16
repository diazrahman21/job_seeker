<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->unique()->constrained('job_seekers')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->timestamps();
        });

        DB::statement(
            "INSERT INTO profiles (job_seeker_id, title, location, bio, profile_photo_path, created_at, updated_at)
             SELECT js.id, u.title, u.location, u.bio, u.profile_photo_path, NOW(), NOW()
             FROM users u
             INNER JOIN job_seekers js ON js.user_id = u.id"
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
