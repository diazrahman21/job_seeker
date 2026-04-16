<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        $companyNames = [
            'PT Nusantara Digital',
            'PT Inovasi Teknologi Indonesia',
            'PT Solusi Karya Bangsa',
            'PT Cipta Data Mandiri',
            'PT Awan Komputasi Indonesia',
            'PT Kreatif Media Nusantara',
            'PT Sigma Sistem Informasi',
            'PT Mitra Talenta Indonesia',
            'PT Pilar Integrasi Digital',
            'PT Garuda Teknologi Sejahtera',
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

        $industries = [
            'Teknologi Informasi',
            'Fintech',
            'E-Commerce',
            'SaaS',
            'Media Digital',
            'Game Development',
            'IoT',
            'Cloud Services',
            'Konsultasi IT',
            'Cybersecurity',
        ];

        $companySizes = ['1-50', '51-200', '201-500', '501-1000', '1000+'];

        $name = fake()->randomElement($companyNames);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'email' => fake()->unique()->userName() . '@' . $slug . '.id',
            'description' => 'Perusahaan kami bergerak di bidang teknologi digital dan berfokus pada pengembangan produk inovatif yang membantu bisnis di Indonesia tumbuh lebih cepat. Kami berkomitmen untuk memberikan solusi terbaik dengan tim profesional dan berpengalaman.',
            'website' => 'https://www.' . $slug . '.id',
            'location' => fake()->randomElement($cities),
            'industry' => fake()->randomElement($industries),
            'company_size' => fake()->randomElement($companySizes),
            'founded_year' => fake()->year() >= 2010 ? fake()->year() : fake()->numberBetween(2010, 2020),
            'phone' => '+62' . fake()->numberBetween(8, 9) . fake()->numberBetween(100000000, 999999999),
            'status' => 'pending',
        ];
    }
}
