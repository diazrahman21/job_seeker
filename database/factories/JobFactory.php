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

        // Job spesifik dengan deskripsi dan requirements yang relevan
        $jobDetails = [
            'Pengembang Laravel' => [
                'description' => 'Kami mencari Pengembang Laravel berpengalaman untuk bergabung dengan tim development kami. Anda akan bertanggung jawab dalam mengembangkan dan mempertahankan aplikasi web backend yang scalable dan robust. Posisi ini menawarkan kesempatan untuk bekerja dengan teknologi terkini dan tim yang passionate.',
                'requirements' => "- Minimal 3 tahun pengalaman menggunakan Laravel\n- Menguasai PHP, MySQL, dan REST API\n- Familiar dengan Git dan version control\n- Berpengalaman dengan TDD dan unit testing\n- Mampu bekerja dalam tim dan komunikasi yang baik\n- Portfolio atau GitHub profile yang menunjukkan track record",
                'category' => 'Teknik',
                'min' => 8000000,
                'max' => 15000000,
            ],
            'Pengembang Frontend React' => [
                'description' => 'Kami membutuhkan Pengembang Frontend React yang kreativ dan detail-oriented untuk mengembangkan user interface yang menarik dan responsif. Anda akan bekerja sama dengan tim design dan backend untuk menciptakan pengalaman pengguna yang optimal.',
                'requirements' => "- Minimal 2.5 tahun pengalaman dengan React.js\n- Penguasaan JavaScript (ES6+) dan CSS/Tailwind CSS\n- Familiar dengan state management (Redux, Zustand)\n- Berpengalaman dengan webpack dan module bundler\n- Pemahaman tentang responsive design dan cross-browser compatibility\n- Mampu collaborate dengan designer dan developer lainnya\n- Portfolio dengan project React yang mengesankan",
                'category' => 'Teknik',
                'min' => 7500000,
                'max' => 14000000,
            ],
            'Analis Data' => [
                'description' => 'Kami mencari Analis Data yang ahli dalam mengubah data menjadi insights yang actionable. Anda akan menganalisa trend bisnis, membuat visualisasi data, dan memberikan rekomendasi strategis berdasarkan data.',
                'requirements' => "- Minimal 2 tahun pengalaman di data analytics\n- Mahir menggunakan SQL dan Python/R\n- Mampu menggunakan tools BI seperti Tableau atau Power BI\n- Pemahaman statistik dan metodologi analisis\n- Excellent Excel skills\n- Mampu mengkomunikasikan insight data dengan stakeholder\n- Portfolio dengan project data analysis yang relevan",
                'category' => 'Teknik',
                'min' => 9000000,
                'max' => 18000000,
            ],
            'UI/UX Designer' => [
                'description' => 'Kami mencari UI/UX Designer berbakat untuk merancang interface yang user-friendly dan visually appealing. Anda akan bertanggung jawab dalam research, prototyping, dan iterasi design berdasarkan user feedback.',
                'requirements' => "- Minimal 2 tahun pengalaman di UI/UX Design\n- Mahir menggunakan Figma atau Adobe XD\n- Pemahaman mendalam tentang design principles dan user psychology\n- Berpengalaman dengan wireframing, prototyping, dan user testing\n- Portfolio dengan case study design yang menunjukkan proses\n- Mampu collaborate dengan developer dan product manager\n- Knowledge tentang accessibility dan responsive design",
                'category' => 'Desain',
                'min' => 6500000,
                'max' => 12000000,
            ],
            'Spesialis Digital Marketing' => [
                'description' => 'Kami mencari Spesialis Digital Marketing yang kreatif dan data-driven untuk mengembangkan strategi marketing yang efektif. Anda akan mengelola kampanye digital, SEO, SEM, dan social media untuk meningkatkan brand awareness.',
                'requirements' => "- Minimal 2 tahun pengalaman di digital marketing\n- Expertise di Google Ads, Facebook Ads, dan social media marketing\n- Pemahaman tentang SEO dan content marketing\n- Mahir menganalisis metrics dan ROI\n- Berpengalaman dengan Google Analytics dan marketing tools\n- Kemampuan copywriting yang baik\n- Creative thinking dan problem-solving skills",
                'category' => 'Pemasaran',
                'min' => 5500000,
                'max' => 10000000,
            ],
            'DevOps Engineer' => [
                'description' => 'Kami membutuhkan DevOps Engineer yang berpengalaman untuk mengelola infrastruktur cloud dan pipeline CI/CD kami. Anda akan memastikan system reliability, scalability, dan security.',
                'requirements' => "- Minimal 3 tahun pengalaman DevOps\n- Expert dalam Docker dan Kubernetes\n- Mahir dengan AWS/GCP atau cloud platform lainnya\n- Strong knowledge tentang Linux dan networking\n- Berpengalaman dengan CI/CD tools (Jenkins, GitLab CI, GitHub Actions)\n- Infrastructure as Code (Terraform, CloudFormation)\n- Excellent problem-solving dan communication skills",
                'category' => 'Teknik',
                'min' => 10000000,
                'max' => 20000000,
            ],
            'Manajer Produk' => [
                'description' => 'Kami mencari Manajer Produk yang strategis dan visioner untuk memimpin pengembangan produk kami. Anda akan bertanggung jawab dalam product strategy, roadmap, dan collaboration dengan tim engineering dan marketing.',
                'requirements' => "- Minimal 3 tahun pengalaman sebagai Product Manager\n- Track record meluncurkan produk sukses\n- Kemampuan strategic thinking dan data-driven decision making\n- Expertise dalam user research dan competitive analysis\n- Strong communication dan leadership skills\n- Familiar dengan Agile/Scrum methodology\n- Knowledge tentang product metrics dan KPI\n- MBA atau relevant product management certification adalah plus",
                'category' => 'Operasional',
                'min' => 12000000,
                'max' => 25000000,
            ],
            'Quality Assurance Engineer' => [
                'description' => 'Kami mencari QA Engineer yang detail-oriented untuk memastikan kualitas produk kami. Anda akan melakukan testing, bug tracking, dan quality analysis untuk setiap release.',
                'requirements' => "- Minimal 2 tahun pengalaman QA/Testing\n- Berpengalaman dengan automated testing tools (Selenium, Cypress)\n- Mahir dalam manual dan automated testing\n- Knowledge tentang testing methodology dan best practices\n- Familiar dengan JIRA dan bug tracking tools\n- Basic knowledge tentang SQL untuk database testing\n- Attention to detail dan critical thinking skills",
                'category' => 'Teknik',
                'min' => 6000000,
                'max' => 11000000,
            ],
            'Pengembang Mobile Flutter' => [
                'description' => 'Kami membutuhkan Pengembang Mobile Flutter untuk mengembangkan aplikasi mobile yang cross-platform. Anda akan membuat UI yang beautiful dan functional serta mengoptimalkan performance.',
                'requirements' => "- Minimal 2 tahun pengalaman dengan Flutter\n- Strong knowledge tentang Dart programming\n- Berpengalaman integrate dengan REST API dan Firebase\n- Familiar dengan state management (Provider, BLoC)\n- Testing knowledge (unit testing, widget testing)\n- Google Play Store dan App Store deployment experience\n- Portfolio aplikasi Flutter di App Store atau Play Store",
                'category' => 'Teknik',
                'min' => 8500000,
                'max' => 16000000,
            ],
            'Backend Engineer' => [
                'description' => 'Kami mencari Backend Engineer yang solid untuk membangun infrastructure dan API yang scalable. Anda akan bekerja dengan berbagai teknologi backend dan database untuk mendukung aplikasi kami.',
                'requirements' => "- Minimal 3 tahun pengalaman backend development\n- Expertise dalam satu atau lebih bahasa (Java, Python, Go, Node.js)\n- Strong knowledge tentang database design (SQL dan NoSQL)\n- Experience dengan microservices architecture\n- RESTful API design dan documentation\n- Familiar dengan message queues dan caching\n- Basic DevOps knowledge\n- Problem-solving dan code optimization skills",
                'category' => 'Teknik',
                'min' => 8500000,
                'max' => 16000000,
            ],
        ];

        $title = fake()->randomElement($jobTitles);
        $detail = $jobDetails[$title];

        return [
            'title' => $title,
            'description' => $detail['description'],
            'requirements' => $detail['requirements'],
            'location' => fake()->randomElement($cities),
            'category' => $detail['category'],
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'salary_min' => $detail['min'],
            'salary_max' => $detail['max'],
            'deadline_at' => fake()->dateTimeBetween('+7 days', '+60 days'),
            'status' => 'pending',
        ];
    }
}
