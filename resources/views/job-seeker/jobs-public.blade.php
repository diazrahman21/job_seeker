@extends('layouts.app', ['title' => 'Cari Pekerjaan'])

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-2xl p-8 md:p-12">
        <h1 class="text-4xl font-bold mb-2">Temukan Pekerjaan Impianmu</h1>
        <p class="text-blue-100 text-lg">Jelajahi ribuan lowongan pekerjaan dari perusahaan terkemuka</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <form method="get" action="{{ route('jobs.public') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari posisi, perusahaan, atau skill..." 
                    value="{{ request('search') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="flex-1">
                <input 
                    type="text" 
                    name="location" 
                    placeholder="Lokasi..." 
                    value="{{ request('location') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                Cari
            </button>
        </form>
    </div>

    <!-- Jobs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
        <a href="{{ route('jobs.public.detail', $job->id) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all p-6 no-underline group">
            <!-- Company Info -->
            <div class="mb-4 pb-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600">{{ $job->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $job->company->name ?? 'Perusahaan' }}</p>
            </div>

            <!-- Job Details -->
            <div class="space-y-2 text-sm text-gray-700">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1 4.5 4.5 0 1-3.384 5.98z"/>
                    </svg>
                    {{ $job->location }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.5 3a1 1 0 100 2h5a1 1 0 100-2h-5zM0 6a2 2 0 012-2h16a2 2 0 012 2v7a2 2 0 01-2 2H2a2 2 0 01-2-2V6zm2 2a1 1 0 000 2h12a1 1 0 100-2H2z"/>
                    </svg>
                    {{ $job->employment_type }}
                </div>
                @if($job->salary_min && $job->salary_max)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.16 5.314l4.897-1.596A1 1 0 0114.902 6.5v7a1 1 0 11-2 0V8.162l-4.868 1.589a3 3 0 11-1.854-5.737z"/>
                    </svg>
                    Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}
                </div>
                @endif
            </div>

            <!-- Description Preview -->
            <p class="text-sm text-gray-600 mt-4 line-clamp-2">{{ $job->description }}</p>

            <!-- Footer -->
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">{{ $job->applications_count ?? 0 }} pelamar</span>
                <span class="text-xs font-semibold text-blue-600 group-hover:text-blue-700">Lihat Detail →</span>
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Tidak Ada Lowongan</h3>
                <p class="text-gray-600">Coba ubah pencarian atau filter Anda</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="flex justify-center mt-8">
        {{ $jobs->links() }}
    </div>
    @endif

    <!-- CTA for Login -->
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Siap Untuk Mendaftar?</h3>
        <p class="text-gray-700 mb-6">Buat akun sekarang dan mulai apply ke lowongan pekerjaan yang Anda minati</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ route('job-seeker.register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition-colors font-semibold no-underline">
                Daftar Pelamar
            </a>
            <a href="{{ route('job-seeker.login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-xl border border-blue-600 hover:bg-blue-50 transition-colors font-semibold no-underline">
                Masuk
            </a>
        </div>
    </div>
</div>
@endsection
