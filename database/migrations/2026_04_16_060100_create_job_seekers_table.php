<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        DB::statement('INSERT INTO job_seekers (user_id, created_at, updated_at) SELECT id, NOW(), NOW() FROM users');
    }

    public function down(): void
    {
        Schema::dropIfExists('job_seekers');
    }
};
