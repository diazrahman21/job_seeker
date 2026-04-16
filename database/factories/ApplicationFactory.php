<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cover_letter' => 'Saya sangat tertarik dengan posisi ini karena sesuai dengan pengalaman dan minat saya. Saya siap berkontribusi secara maksimal serta beradaptasi dengan budaya kerja tim.',
            'status' => fake()->randomElement(['applied', 'review', 'interview', 'rejected', 'hired']),
            'status_note' => fake()->optional()->randomElement([
                'Kandidat memiliki pengalaman yang relevan.',
                'Perlu dijadwalkan wawancara lanjutan.',
                'Portofolio cukup baik dan sesuai kebutuhan.',
                'Saat ini masih dalam tahap evaluasi tim rekrutmen.',
            ]),
        ];
    }
}
