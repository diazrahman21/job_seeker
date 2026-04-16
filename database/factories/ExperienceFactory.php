<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        $companies = [
            'PT Nusantara Digital',
            'PT Solusi Karya Bangsa',
            'PT Inovasi Cipta Teknologi',
            'PT Mitra Data Indonesia',
            'PT Kolaborasi Sistem',
        ];

        $titles = [
            'Pengembang Web',
            'Analis Sistem',
            'Spesialis QA',
            'Desainer Produk Digital',
            'Staf Operasional Teknologi',
        ];

        return [
            'company_name' => fake()->randomElement($companies),
            'job_title' => fake()->randomElement($titles),
            'start_date' => fake()->dateTimeBetween('-8 years', '-2 years'),
            'end_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'description' => 'Bertanggung jawab mengelola proyek harian, berkoordinasi dengan tim lintas divisi, serta memastikan target pekerjaan tercapai sesuai jadwal.',
        ];
    }
}
