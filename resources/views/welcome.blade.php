@extends('layouts.app')

@section('content')
<section class="rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 p-8 text-white md:p-16 mb-12 shadow-xl">
    <div class="grid gap-12 md:grid-cols-2 items-center">
        <!-- Left Content -->
        <div>
            <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-sm px-4 py-2 text-sm font-bold tracking-wide border border-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15a23.931 23.931 0 01-9-1.744M12 3v2.868a.02.02 0 00.062.062l5.192 5.191a1.978 1.978 0 01.578 2.197l-.243.915m6.519.073a23.9 23.9 0 01-3.8 5.396m-5.241-3.601c1.5.084 3.01.249 4.509.25m0 0a24.987 24.987 0 01-5.738 1.12" /></svg>
                Recruitment Platform
            </div>
            
            <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4">
                Job Board & <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-blue-200">Recruitment</span>
            </h1>
            
            <p class="text-lg text-blue-100 max-w-xl mb-8 leading-relaxed">
                Platform rekrutmen all-in-one untuk pelamar kerja, perusahaan, dan admin. Temukan peluang karir terbaik atau temukan talenta terbaik dengan mudah.
            </p>
            
            <!-- Main CTA -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('jobs.public') }}" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl transition-all transform hover:scale-105 shadow-lg no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                    Jelajahi Lowongan
                </a>
                <a href="#features" class="inline-flex items-center justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/40 text-white font-bold py-3 px-8 rounded-xl transition-all no-underline">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>

        <!-- Right Auth Buttons Grid -->
        <div class="grid grid-cols-1 gap-3">
            <!-- Job Seeker Section -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4">
                <p class="text-xs text-blue-100 font-semibold mb-3 uppercase">Pencari Kerja</p>
                <div class="space-y-2">
                    <a href="{{ route('job-seeker.login') }}" class="block w-full bg-white text-blue-700 font-bold py-2.5 px-4 rounded-xl text-center hover:bg-gray-100 transition-colors no-underline">
                        Masuk
                    </a>
                    <a href="{{ route('job-seeker.register') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-xl text-center transition-colors no-underline">
                        Daftar Akun
                    </a>
                </div>
            </div>

            <!-- Recruiter Section -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4">
                <p class="text-xs text-blue-100 font-semibold mb-3 uppercase">Perusahaan / Rekruter</p>
                <div class="space-y-2">
                    <a href="{{ route('recruiter.login') }}" class="block w-full bg-white text-blue-700 font-bold py-2.5 px-4 rounded-xl text-center hover:bg-gray-100 transition-colors no-underline">
                        Masuk
                    </a>
                    <a href="{{ route('recruiter.register') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-xl text-center transition-colors no-underline">
                        Daftar Gratis
                    </a>
                </div>
            </div>

            <!-- Admin Section -->
            <a href="{{ route('admin.login') }}" class="bg-white/10 backdrop-blur-md border border-white/40 hover:border-white/60 text-white font-bold py-3 px-4 rounded-xl text-center transition-all no-underline">
                Admin Login
            
                    Jelajahi Lowongan
                </a>
                <a href="#features" class="inline-flex items-center justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/40 text-white font-bold py-3 px-8 rounded-xl transition-all no-underline">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>

        <!-- Right Auth Buttons Grid -->
        <div class="grid grid-cols-1 gap-3">
            <!-- Job Seeker Section -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4">
                <p class="text-xs text-blue-100 font-semibold mb-3 uppercase">Pencari Kerja</p>
                <div class="space-y-2">
                    <a href="{{ route('job-seeker.login') }}" class="block w-full bg-white text-blue-700 font-bold py-2.5 px-4 rounded-xl text-center hover:bg-gray-100 transition-colors no-underline">
                        Masuk
                    </a>
                    <a href="{{ route('job-seeker.register') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-xl text-center transition-colors no-underline">
                        Daftar Akun
                    </a>
                </div>
            </div>

            <!-- Recruiter Section -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4">
                <p class="text-xs text-blue-100 font-semibold mb-3 uppercase">Perusahaan / Rekruter</p>
                <div class="space-y-2">
                    <a href="{{ route('recruiter.login') }}" class="block w-full bg-white text-blue-700 font-bold py-2.5 px-4 rounded-xl text-center hover:bg-gray-100 transition-colors no-underline">
                        Masuk
                    </a>
                    <a href="{{ route('recruiter.register') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-xl text-center transition-colors no-underline">
                        Daftar Gratis
                    </a>
                </div>
            </div>

            <!-- Admin Section -->
            <a href="{{ route('admin.login') }}" class="bg-white/10 backdrop-blur-md border border-white/40 hover:border-white/60 text-white font-bold py-3 px-4 rounded-xl text-center transition-all no-underline">
                Admin Login
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 px-4 mb-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Fitur Unggulan</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Platform lengkap untuk semua kebutuhan rekrutmen dan pencarian kerja</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition-shadow">
                <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Cari Pekerjaan Mudah</h3>
                <p class="text-gray-600">Temukan ribuan lowongan dari perusahaan terkemuka dengan filter pencarian yang lengkap</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition-shadow">
                <div class="bg-green-100 text-green-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Posting Lowongan Cepat</h3>
                <p class="text-gray-600">Perusahaan dapat membuat dan mengelola lowongan kerja dengan dashboard yang intuitif</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition-shadow">
                <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Kelola Pelamar</h3>
                <p class="text-gray-600">Sistem manajemen aplikasi lengkap untuk melacak dan berkomunikasi dengan kandidat</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Jobs Section -->
<section class="py-16 px-4 bg-gray-50 rounded-3xl mb-12">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Lowongan Terbaru</h2>
                <p class="text-gray-600 text-lg">Kesempatan emas dari perusahaan terkemuka</p>
            </div>
            <a href="{{ route('jobs.public') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-colors no-underline inline-flex items-center gap-2">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <p class="text-3xl font-bold text-blue-600 mb-1">1000+</p>
                <p class="text-gray-600 font-medium">Lowongan Aktif</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <p class="text-3xl font-bold text-green-600 mb-1">500+</p>
                <p class="text-gray-600 font-medium">Perusahaan</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <p class="text-3xl font-bold text-purple-600 mb-1">5000+</p>
                <p class="text-gray-600 font-medium">Pencari Kerja</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <p class="text-3xl font-bold text-orange-600 mb-1">100+</p>
                <p class="text-gray-600 font-medium">Hiring Sukses</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="rounded-3xl bg-gradient-to-r from-green-500 to-blue-600 p-8 md:p-16 text-white text-center mb-12 shadow-xl">
    <h2 class="text-4xl md:text-5xl font-bold mb-4">Siap Memulai?</h2>
    <p class="text-lg text-white/90 max-w-2xl mx-auto mb-8">
        Bergabunglah dengan ribuan pencari kerja dan perusahaan yang telah menemukan kesempatan sempurna
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('job-seeker.register') }}" class="bg-white text-blue-600 font-bold py-3 px-8 rounded-xl hover:bg-gray-100 transition-colors no-underline">
            Daftar Sebagai Pencari Kerja
        </a>
        <a href="{{ route('recruiter.register') }}" class="bg-green-400 hover:bg-green-500 text-gray-900 font-bold py-3 px-8 rounded-xl transition-colors no-underline">
            Daftar Sebagai Perusahaan
        </a>
    </div>
</section>
@endsection
