<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->index(['job_seeker_id', 'name']);
        });

        $users = DB::table('users')->select('id', 'skills')->get();

        foreach ($users as $user) {
            if (empty($user->skills)) {
                continue;
            }

            $decoded = json_decode($user->skills, true);
            if (! is_array($decoded)) {
                continue;
            }

            $jobSeekerId = DB::table('job_seekers')->where('user_id', $user->id)->value('id');
            if (! $jobSeekerId) {
                continue;
            }

            foreach ($decoded as $skill) {
                $skillName = trim((string) $skill);
                if ($skillName === '') {
                    continue;
                }

                DB::table('skills')->insert([
                    'job_seeker_id' => $jobSeekerId,
                    'name' => $skillName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
