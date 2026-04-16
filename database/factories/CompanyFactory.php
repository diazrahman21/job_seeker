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

        $name = fake()->randomElement($companyNames);

        return [
            'name' => $name,
            'email' => fake()->unique()->userName() . '@perusahaan.id',
            'description' => 'Perusahaan ini bergerak di bidang teknologi digital dan berfokus pada pengembangan produk yang membantu bisnis di Indonesia tumbuh lebih cepat.',
            'website' => 'https://www.' . Str::slug($name) . '.co.id',
            'location' => fake()->randomElement($cities),
            'status' => 'pending',
        ];
    }
}
