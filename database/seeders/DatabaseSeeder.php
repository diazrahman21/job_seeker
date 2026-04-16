<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Company;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\SkillOption;
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

        // Create skill options first
        $this->seedSkillOptions();

        // Demo Company - PT Example Tech
        $demoCompany = Company::updateOrCreate([
            'email' => 'demo@exampletech.id',
        ], [
            'name' => 'PT Example Tech Indonesia',
            'password' => Hash::make('demo123'),
            'status' => 'approved',
            'description' => 'PT Example Tech Indonesia adalah perusahaan teknologi terkemuka yang berfokus pada pengembangan solusi software enterprise dan konsultasi digital transformation. Dengan tim profesional berpengalaman lebih dari 10 tahun, kami telah membantu ratusan perusahaan di Indonesia untuk meningkatkan efisiensi operasional melalui teknologi digital. Kami percaya bahwa inovasi adalah kunci kesuksesan di era digital ini.',
            'website' => 'https://www.exampletech.id',
            'location' => 'Jakarta',
            'industry' => 'Teknologi Informasi',
            'company_size' => '201-500',
            'founded_year' => 2015,
            'phone' => '+62215551234',
            'social_media' => json_encode([
                'linkedin' => 'https://linkedin.com/company/pt-example-tech-indonesia',
                'twitter' => 'https://twitter.com/exampletechid',
                'instagram' => 'https://instagram.com/exampletechid',
            ]),
        ]);

        // Regular companies
        $companies = Company::factory()->count(9)->create([
            'password' => Hash::make('password123'),
            'status' => 'approved',
        ]);
        
        $allCompanies = collect([$demoCompany])->merge($companies);

        $jobs = collect();
        foreach ($allCompanies as $company) {
            // Demo company gets 5 jobs, others get 3
            $jobCount = $company->id === $demoCompany->id ? 5 : 3;
            $jobs = $jobs->merge(Job::factory()->count($jobCount)->create([
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

            // Assign random skills from skill_options
            $randomSkills = SkillOption::inRandomOrder()->limit(rand(2, 5))->get();
            foreach ($randomSkills as $skill) {
                $jobSeeker->skills()->firstOrCreate([
                    'skill_option_id' => $skill->id,
                    'name' => $skill->name,
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

            $appliedJobs = $jobs->random(random_int(3, 6));
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

    private function seedSkillOptions(): void
    {
        $skills = [
            'Laravel', 'PHP', 'MySQL', 'PostgreSQL', 'REST API',
            'JavaScript', 'TypeScript', 'React', 'Vue.js', 'Node.js',
            'Tailwind CSS', 'HTML/CSS', 'Git', 'Docker', 'Linux',
            'Unit Testing', 'CI/CD', 'UI/UX Design', 'Figma', 'Product Management',
            'Digital Marketing', 'SEO', 'Data Analysis', 'Communication', 'Problem Solving',
        ];

        foreach ($skills as $skillName) {
            SkillOption::firstOrCreate(['name' => $skillName]);
        }
    }
}
