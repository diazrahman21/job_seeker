<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        $companies = [
            [
                'name' => 'PT Nusantara Digital',
                'industry' => 'Teknologi Informasi',
                'description' => 'PT Nusantara Digital adalah perusahaan pengembang software yang berfokus pada solusi enterprise untuk kebutuhan bisnis modern. Dengan pengalaman lebih dari 8 tahun, kami telah membantu ratusan perusahaan di Indonesia untuk mentransformasi operasional digital mereka. Tim kami terdiri dari talenta-talenta terbaik di bidang teknologi yang siap memberikan solusi terbaik.',
            ],
            [
                'name' => 'PT Inovasi Teknologi Indonesia',
                'industry' => 'Fintech',
                'description' => 'Sebagai pemimpin industri fintech di Indonesia, PT Inovasi Teknologi Indonesia menghadirkan solusi pembayaran digital yang aman, cepat, dan terjangkau. Kami berkomitmen untuk memberdayakan masyarakat Indonesia melalui teknologi keuangan digital yang inklusif dan inovatif.',
            ],
            [
                'name' => 'PT Solusi Karya Bangsa',
                'industry' => 'E-Commerce',
                'description' => 'PT Solusi Karya Bangsa adalah platform e-commerce yang menghubungkan jutaan penjual dan pembeli di seluruh Indonesia. Kami menyediakan ekosistem perdagangan digital yang lengkap dengan berbagai tools dan layanan untuk memaksimalkan kesuksesan bisnis online Anda.',
            ],
            [
                'name' => 'PT Cipta Data Mandiri',
                'industry' => 'SaaS',
                'description' => 'PT Cipta Data Mandiri menyediakan platform SaaS terdepan untuk manajemen data enterprise. Dengan infrastruktur cloud yang scalable dan tim support 24/7, kami memastikan bisnis Anda dapat mengelola data dengan aman dan efisien.',
            ],
            [
                'name' => 'PT Awan Komputasi Indonesia',
                'industry' => 'Cloud Services',
                'description' => 'PT Awan Komputasi Indonesia adalah penyedia layanan cloud computing terpercaya di Asia Tenggara. Kami menawarkan infrastruktur cloud yang handal, skalabel, dan cost-effective untuk mendukung pertumbuhan bisnis Anda.',
            ],
            [
                'name' => 'PT Kreatif Media Nusantara',
                'industry' => 'Media Digital',
                'description' => 'PT Kreatif Media Nusantara adalah agensi produksi konten digital terkemuka di Indonesia. Kami menciptakan konten berkualitas tinggi, viral, dan engaging untuk berbagai platform media sosial dan digital.',
            ],
            [
                'name' => 'PT Sigma Sistem Informasi',
                'industry' => 'Konsultasi IT',
                'description' => 'PT Sigma Sistem Informasi memberikan konsultasi IT strategis untuk transformasi digital perusahaan Anda. Dengan track record menangani lebih dari 200 klien korporat, kami memiliki expertise dalam implementasi sistem IT enterprise-level.',
            ],
            [
                'name' => 'PT Mitra Talenta Indonesia',
                'industry' => 'Software as a Service',
                'description' => 'PT Mitra Talenta Indonesia mengembangkan platform HRIS dan talent management yang komprehensif. Kami membantu perusahaan mengelola sumber daya manusia mereka dengan lebih efisien dan strategis.',
            ],
            [
                'name' => 'PT Pilar Integrasi Digital',
                'industry' => 'IoT',
                'description' => 'PT Pilar Integrasi Digital adalah pionir dalam solusi IoT dan smart devices di Indonesia. Kami mengembangkan teknologi Internet of Things yang mengubah cara industri beroperasi dan meningkatkan produktivitas.',
            ],
            [
                'name' => 'PT Garuda Teknologi Sejahtera',
                'industry' => 'Cybersecurity',
                'description' => 'PT Garuda Teknologi Sejahtera adalah penyedia solusi cybersecurity terpercaya untuk melindungi data dan infrastruktur digital perusahaan Anda. Dengan tim ahli keamanan siber bersertifikat internasional, kami memastikan perlindungan maksimal terhadap ancaman digital.',
            ],
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

        $companySizes = ['1-50', '51-200', '201-500', '501-1000', '1000+'];

        $company = fake()->randomElement($companies);
        $slug = Str::slug($company['name']);

        return [
            'name' => $company['name'],
            'email' => fake()->unique()->userName() . '@' . $slug . '.id',
            'description' => $company['description'],
            'website' => 'https://www.' . $slug . '.id',
            'location' => fake()->randomElement($cities),
            'industry' => $company['industry'],
            'company_size' => fake()->randomElement($companySizes),
            'founded_year' => fake()->numberBetween(2010, 2020),
            'phone' => '+62' . fake()->numberBetween(8, 9) . fake()->numberBetween(100000000, 999999999),
            'status' => 'pending',
        ];
    }
}
