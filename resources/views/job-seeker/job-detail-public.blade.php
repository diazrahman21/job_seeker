@extends('layouts.app', ['title' => $job->title . ' - ' . $job->company->name])

@section('content')
<div class="space-y-6">
    <!-- Back Link -->
    <a href="{{ route('jobs.public') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center gap-1 no-underline">
        ← Kembali ke Daftar Lowongan
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
                        <p class="text-lg text-gray-600">{{ $job->company->name }}</p>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-y border-gray-100">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Lokasi</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Tipe Pekerjaan</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $job->employment_type }}</p>
                    </div>
                    @if($job->salary_min && $job->salary_max)
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Gaji</p>
                        <p class="text-sm font-semibold text-gray-900 mt-1">Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Pelamar</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $applicationsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi Pekerjaan</h2>
                <div class="prose prose-sm text-gray-700 whitespace-pre-wrap">
                    {{ $job->description }}
                </div>
            </div>

            <!-- Requirements -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Persyaratan</h2>
                <div class="prose prose-sm text-gray-700 whitespace-pre-wrap">
                    {{ $job->requirements }}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Company Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 sticky top-6">
                <h3 class="font-bold text-gray-900 mb-4">Tentang Perusahaan</h3>
                <p class="text-sm text-gray-600 mb-4">{{ $job->company->description ?? 'Tidak ada deskripsi' }}</p>
                
                @if($job->company->location)
                <div class="mb-3">
                    <p class="text-xs text-gray-600 font-semibold uppercase">Lokasi</p>
                    <p class="text-sm text-gray-900">{{ $job->company->location }}</p>
                </div>
                @endif

                @if($job->company->industry)
                <div class="mb-3">
                    <p class="text-xs text-gray-600 font-semibold uppercase">Industri</p>
                    <p class="text-sm text-gray-900">{{ $job->company->industry }}</p>
                </div>
                @endif

                <div class="pt-4 border-t border-gray-100">
                    <a href="{{ route('companies.profile', $job->company->id) }}" class="block text-center bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-colors font-semibold no-underline text-sm">
                        Lihat Profil Perusahaan
                    </a>
                </div>
            </div>

            <!-- CTA -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-6">
                <h3 class="font-bold mb-2">Tertarik dengan Lowongan Ini?</h3>
                <p class="text-sm text-blue-100 mb-4">Daftar atau masuk untuk melamar sekarang</p>
                <div class="space-y-3">
                    <a href="{{ route('job-seeker.register') }}" class="block text-center bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors font-semibold no-underline text-sm">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('job-seeker.login') }}" class="block text-center border border-white text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold no-underline text-sm">
                        Masuk
                    </a>
                </div>
            </div>

            <!-- Share -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                <h3 class="font-bold text-gray-900 mb-3">Bagikan</h3>
                <div class="flex gap-2">
                    <a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition-colors no-underline">f</a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition-colors no-underline">𝕏</a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition-colors no-underline">in</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
