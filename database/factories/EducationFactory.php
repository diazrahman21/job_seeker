<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->numberBetween(2010, 2018);

        $universities = [
            'Universitas Indonesia',
            'Institut Teknologi Bandung',
            'Universitas Gadjah Mada',
            'Universitas Airlangga',
            'Institut Teknologi Sepuluh Nopember',
            'Universitas Brawijaya',
            'Universitas Diponegoro',
        ];

        return [
            'school_name' => fake()->randomElement($universities),
            'degree' => fake()->randomElement(['S1', 'S2', 'Diploma']),
            'field_of_study' => fake()->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen Bisnis', 'Desain Komunikasi Visual']),
            'start_year' => $start,
            'end_year' => $start + fake()->numberBetween(3, 5),
            'description' => 'Aktif dalam kegiatan akademik dan organisasi kampus serta memiliki ketertarikan kuat pada pengembangan karier profesional.',
        ];
    }
}
