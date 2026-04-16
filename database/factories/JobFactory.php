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

        // Salary ranges by job title (realistic Indonesian market)
        $salaryRanges = [
            'Pengembang Laravel' => ['min' => 8000000, 'max' => 15000000],
            'Pengembang Frontend React' => ['min' => 7500000, 'max' => 14000000],
            'Analis Data' => ['min' => 9000000, 'max' => 18000000],
            'UI/UX Designer' => ['min' => 6500000, 'max' => 12000000],
            'Spesialis Digital Marketing' => ['min' => 5500000, 'max' => 10000000],
            'DevOps Engineer' => ['min' => 10000000, 'max' => 20000000],
            'Manajer Produk' => ['min' => 12000000, 'max' => 25000000],
            'Quality Assurance Engineer' => ['min' => 6000000, 'max' => 11000000],
            'Pengembang Mobile Flutter' => ['min' => 8500000, 'max' => 16000000],
            'Backend Engineer' => ['min' => 8500000, 'max' => 16000000],
        ];

        $title = fake()->randomElement($jobTitles);
        $salaryRange = $salaryRanges[$title];

        return [
            'title' => $title,
            'description' => 'Kami mencari talenta terbaik yang siap berkolaborasi dalam tim lintas fungsi, mampu menyelesaikan masalah dengan cepat, dan memiliki semangat belajar tinggi untuk mendukung pertumbuhan produk perusahaan. Posisi ini menawarkan kesempatan besar untuk berkembang dan belajar teknologi terkini.',
            'requirements' => "- Minimal 2 tahun pengalaman kerja relevan\n- Menguasai komunikasi dan kerja tim\n- Terbiasa dengan target dan tenggat waktu\n- Memiliki portofolio atau proyek nyata\n- Bersedia berkembang dengan teknologi terbaru",
            'location' => fake()->randomElement($cities),
            'category' => fake()->randomElement(['Teknik', 'Desain', 'Pemasaran', 'Operasional']),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'salary_min' => $salaryRange['min'],
            'salary_max' => $salaryRange['max'],
            'deadline_at' => fake()->dateTimeBetween('+7 days', '+60 days'),
            'status' => 'pending',
        ];
    }
}
