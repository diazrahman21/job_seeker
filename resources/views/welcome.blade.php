@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-50 py-12 md:py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid gap-8 md:grid-cols-2 items-center">
            <!-- Left Content -->
            <div>
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-blue-50 border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Platform Rekrutmen Modern
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 leading-tight mb-4">
                    Platform Rekrutmen All-in-One untuk Kesempatan Sempurna
                </h1>
                
                <p class="text-lg text-slate-600 max-w-xl mb-8">
                    Temukan peluang karir terbaik atau temukan talenta terbaik dengan mudah. Platform lengkap untuk pencari kerja, perusahaan, dan administrator.
                </p>
                
                <!-- Main CTA -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('jobs.public') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 hover:shadow-md no-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                        </svg>
                        Jelajahi Lowongan
                    </a>
                    <a href="#features" class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold py-3 px-8 rounded-xl transition-all duration-200 no-underline">
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>

            <!-- Right Auth Cards Grid -->
            <div class="space-y-4">
                <!-- Job Seeker Section -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900">Pencari Kerja</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">Temukan pekerjaan impian Anda hari ini</p>
                    <div class="space-y-2">
                        <a href="{{ route('job-seeker.login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 !text-white font-bold py-2.5 px-4 rounded-lg text-center transition-colors no-underline text-sm">
                            Masuk
                        </a>
                        <a href="{{ route('job-seeker.register') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold py-2.5 px-4 rounded-lg text-center transition-colors no-underline text-sm">
                            Daftar Gratis
                        </a>
                    </div>
                </div>

                <!-- Recruiter Section -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-green-100 text-green-600 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m0 0C5.106 7.055 3.75 8.457 3.75 10.128v7.371c0 2.278 3.694 4.125 8.25 4.125s8.25-1.847 8.25-4.125v-7.371c0-1.671-1.356-3.073-2.25-3.753" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900">Perusahaan / Rekruter</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">Temukan talenta terbaik dengan mudah</p>
                    <div class="space-y-2">
                        <a href="{{ route('recruiter.login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 !text-white font-bold py-2.5 px-4 rounded-lg text-center transition-colors no-underline text-sm">
                            Masuk
                        </a>
                        <a href="{{ route('recruiter.register') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold py-2.5 px-4 rounded-lg text-center transition-colors no-underline text-sm">
                            Daftar Gratis
                        </a>
                    </div>
                </div>

                <!-- Admin Section -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-purple-100 text-purple-600 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900">Administrator</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">Kelola platform dengan mudah</p>
                    <a href="{{ route('admin.login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 !text-white font-bold py-2.5 px-4 rounded-lg text-center transition-colors no-underline text-sm">
                        Masuk Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 md:py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3">Fitur Unggulan</h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">Platform lengkap dengan fitur-fitur canggih untuk memenuhi kebutuhan rekrutmen Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Pencarian Mudah</h3>
                <p class="text-slate-600">Temukan ribuan lowongan dari perusahaan terkemuka dengan filter pencarian yang lengkap dan relevan</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="bg-green-100 text-green-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Posting Lowongan</h3>
                <p class="text-slate-600">Buat dan kelola lowongan kerja dengan dashboard yang intuitif dan mudah digunakan</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m0 0h6m0 0h-6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Kelola Pelamar</h3>
                <p class="text-slate-600">Sistem manajemen aplikasi lengkap untuk melacak dan berkomunikasi dengan kandidat</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-gray-50 py-16 md:py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">Dipercaya oleh Ribuan</h2>
            <p class="text-lg text-slate-600">Bergabunglah dengan komunitas pencari kerja dan perusahaan di seluruh Indonesia</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <p class="text-4xl font-bold text-blue-600 mb-2">1000+</p>
                <p class="text-slate-600 font-medium">Lowongan Aktif</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <p class="text-4xl font-bold text-green-600 mb-2">500+</p>
                <p class="text-slate-600 font-medium">Perusahaan</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <p class="text-4xl font-bold text-purple-600 mb-2">5000+</p>
                <p class="text-slate-600 font-medium">Pencari Kerja</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <p class="text-4xl font-bold text-blue-600 mb-2">100+</p>
                <p class="text-slate-600 font-medium">Hiring Sukses</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-20 px-4">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Siap Memulai Perjalanan Karir Anda?</h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-8">
            Bergabunglah dengan ribuan pencari kerja dan perusahaan yang telah menemukan kesempatan sempurna di platform kami
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('job-seeker.register') }}" class="bg-blue-600 hover:bg-blue-700 !text-white font-bold py-3 px-8 rounded-xl transition-all duration-200 hover:shadow-md no-underline inline-flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Daftar Pencari Kerja
            </a>
            <a href="{{ route('recruiter.register') }}" class="bg-gray-100 hover:bg-gray-200 text-slate-700 font-bold py-3 px-8 rounded-xl transition-all duration-200 no-underline inline-flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m0 0C5.106 7.055 3.75 8.457 3.75 10.128v7.371c0 2.278 3.694 4.125 8.25 4.125s8.25-1.847 8.25-4.125v-7.371c0-1.671-1.356-3.073-2.25-3.753" />
                </svg>
                Daftar Perusahaan
            </a>
        </div>
    </div>
</section>
@endsection
