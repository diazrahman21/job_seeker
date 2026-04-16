<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        $now = now();
        $skills = [
            'Laravel',
            'PHP',
            'MySQL',
            'PostgreSQL',
            'REST API',
            'JavaScript',
            'TypeScript',
            'React',
            'Vue.js',
            'Node.js',
            'Tailwind CSS',
            'HTML/CSS',
            'Git',
            'Docker',
            'Linux',
            'Unit Testing',
            'CI/CD',
            'UI/UX Design',
            'Figma',
            'Product Management',
            'Digital Marketing',
            'SEO',
            'Data Analysis',
            'Communication',
            'Komunikasi',
            'Kerja Tim',
            'Problem Solving',
        ];

        $rows = array_map(static fn (string $name): array => [
            'name' => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ], $skills);

        DB::table('skill_options')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_options');
    }
};
