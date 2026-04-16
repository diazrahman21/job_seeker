<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        $jobTitles = [
            'Pengembang Laravel',
            'Pengembang Frontend React',
            'Analis Data',
            'UI/UX Designer',
            'Spesialis Digital Marketing',
            'DevOps Engineer',
            'Manajer Produk',
            'Quality Assurance Engineer',
            'Pengembang Mobile Flutter',
            'Backend Engineer',
        ];

        $cities = [
            'Jakarta',
            'Bandung',
            'Surabaya',
            'Yogyakarta',
            'Semarang',
            'Medan',
            'Makassar',
            'Denpasar',
            'Balikpapan',
            'Palembang',
        ];

        return [
            'title' => fake()->randomElement($jobTitles),
            'description' => 'Kami mencari kandidat yang siap berkolaborasi dalam tim lintas fungsi, mampu menyelesaikan masalah dengan cepat, dan memiliki semangat belajar tinggi untuk mendukung pertumbuhan produk perusahaan.',
            'requirements' => "- Minimal 2 tahun pengalaman kerja relevan\n- Menguasai komunikasi dan kerja tim\n- Terbiasa dengan target dan tenggat waktu\n- Memiliki portofolio atau proyek nyata",
            'location' => fake()->randomElement($cities),
            'category' => fake()->randomElement(['Teknik', 'Desain', 'Pemasaran', 'Operasional']),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'salary_min' => fake()->numberBetween(5000000, 15000000),
            'salary_max' => fake()->numberBetween(16000000, 35000000),
            'deadline_at' => fake()->dateTimeBetween('+7 days', '+60 days'),
            'status' => 'pending',
        ];
    }
}
