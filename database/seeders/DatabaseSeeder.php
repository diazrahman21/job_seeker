<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Company;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate([
            'email' => 'admin@jobboard.test',
        ], [
            'name' => 'Platform Admin',
            'password' => Hash::make('password123'),
        ]);

        $companies = Company::factory()->count(10)->create([
            'password' => Hash::make('password123'),
            'status' => 'approved',
        ]);

        $jobs = collect();
        foreach ($companies as $company) {
            $jobs = $jobs->merge(Job::factory()->count(3)->create([
                'company_id' => $company->id,
                'status' => 'approved',
            ]));
        }

        $seekers = User::factory()->count(20)->create([
            'password' => Hash::make('password123'),
        ]);

        foreach ($seekers as $user) {
            $jobSeeker = $user->jobSeeker()->firstOrCreate();

            $jobSeeker->profile()->updateOrCreate([], [
                'title' => $user->title,
                'location' => $user->location,
                'bio' => $user->bio,
                'profile_photo_path' => $user->profile_photo_path,
            ]);

            foreach (($user->skills ?? []) as $skillName) {
                $jobSeeker->skills()->firstOrCreate([
                    'name' => $skillName,
                ]);
            }

            Experience::factory()->count(2)->create([
                'user_id' => $user->id,
                'job_seeker_id' => $jobSeeker->id,
            ]);

            Education::factory()->count(1)->create([
                'user_id' => $user->id,
                'job_seeker_id' => $jobSeeker->id,
            ]);

            $appliedJobs = $jobs->random(random_int(2, 4));
            foreach ($appliedJobs as $job) {
                Application::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        User::query()->each(function (User $user): void {
            $jobSeeker = $user->jobSeeker()->firstOrCreate();

            $jobSeeker->profile()->firstOrCreate([], [
                'title' => $user->title,
                'location' => $user->location,
                'bio' => $user->bio,
                'profile_photo_path' => $user->profile_photo_path,
            ]);
        });
    }
}
