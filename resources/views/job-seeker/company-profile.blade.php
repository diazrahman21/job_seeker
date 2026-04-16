@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <!-- Company Header -->
    <div class="rounded-xl border bg-white p-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-slate-900">{{ $company->name }}</h1>
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $company->website }}</a>
                @endif
                <p class="mt-2 text-slate-600">{{ $company->location }}</p>
            </div>
        </div>

        <!-- Company Details Grid -->
        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4 border-t pt-6">
            @if($company->industry)
                <div>
                    <p class="text-sm font-medium text-slate-500">Industri</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $company->industry }}</p>
                </div>
            @endif
            @if($company->company_size)
                <div>
                    <p class="text-sm font-medium text-slate-500">Ukuran Perusahaan</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $company->company_size }}</p>
                </div>
            @endif
            @if($company->founded_year)
                <div>
                    <p class="text-sm font-medium text-slate-500">Tahun Berdiri</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $company->founded_year }}</p>
                </div>
            @endif
            @if($company->phone)
                <div>
                    <p class="text-sm font-medium text-slate-500">Telepon</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $company->phone }}</p>
                </div>
            @endif
        </div>

        <!-- Company Description -->
        @if($company->description)
            <div class="mt-6 border-t pt-6">
                <h2 class="mb-3 text-lg font-semibold text-slate-900">Tentang Perusahaan</h2>
                <p class="leading-relaxed text-slate-700">{{ $company->description }}</p>
            </div>
        @endif

        <!-- Social Media -->
        @php
            $socialMedia = json_decode($company->social_media, true) ?? [];
            $hasLinks = array_filter($socialMedia);
        @endphp
        @if($hasLinks)
            <div class="mt-6 border-t pt-6">
                <h2 class="mb-3 text-lg font-semibold text-slate-900">Ikuti Kami</h2>
                <div class="flex flex-wrap gap-3">
                    @if(!empty($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                            LinkedIn
                        </a>
                    @endif
                    @if(!empty($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                    @endif
                    @if(!empty($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-pink-100 px-4 py-2 text-sm font-medium text-pink-700 hover:bg-pink-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0m0 3.77c2.158 0 2.413.01 3.265.047.787.036 1.213.17 1.497.282a2.506 2.506 0 01.928.603 2.506 2.506 0 01.602.928c.113.284.246.71.283 1.497.035.851.046 1.107.046 3.264s-.01 2.413-.046 3.265c-.036.787-.17 1.213-.282 1.497a2.506 2.506 0 01-.603.928 2.506 2.506 0 01-.928.602c-.284.113-.71.246-1.497.283-.851.035-1.107.046-3.265.046s-2.413-.01-3.264-.046c-.787-.036-1.213-.17-1.497-.282a2.506 2.506 0 01-.928-.603 2.506 2.506 0 01-.602-.928c-.113-.284-.246-.71-.283-1.497-.035-.851-.046-1.107-.046-3.264s.01-2.413.046-3.265c.036-.787.17-1.213.282-1.497a2.506 2.506 0 01.603-.928 2.506 2.506 0 01.928-.602c.284-.113.71-.246 1.497-.283.851-.035 1.107-.046 3.265-.046m0-1.54c-2.191 0-2.463.009-3.327.048-.864.039-1.453.175-1.97.373A3.331 3.331 0 003.9 3.9a3.331 3.331 0 01.98-1.805c.517-.198 1.106-.334 1.97-.373.863-.04 1.136-.049 3.327-.049s2.463.009 3.327.048c.864.039 1.453.175 1.97.373a3.331 3.331 0 011.805.98 3.331 3.331 0 01.98 1.805c.198.517.334 1.106.373 1.97.04.863.049 1.136.049 3.327s-.009 2.463-.048 3.327c-.039.864-.175 1.453-.373 1.97a3.331 3.331 0 01-.98 1.805 3.331 3.331 0 01-1.805.98c-.517.198-1.106.334-1.97.373-.863.04-1.136.049-3.327.049s-2.463-.009-3.327-.048c-.864-.039-1.453-.175-1.97-.373a3.331 3.331 0 01-1.805-.98 3.331 3.331 0 01-.98-1.805c-.198-.517-.334-1.106-.373-1.97-.04-.863-.049-1.136-.049-3.327z"/></svg>
                            Instagram
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Job Listings -->
    @if($jobs->count() > 0)
        <div class="rounded-xl border bg-white p-6">
            <h2 class="mb-4 text-2xl font-bold text-slate-900">Lowongan dari Perusahaan Ini</h2>
            <div class="space-y-4">
                @foreach($jobs as $job)
                    <a href="{{ route('job-seeker.jobs.detail', $job) }}" class="block rounded-lg border border-slate-200 p-4 hover:border-slate-300 hover:bg-slate-50 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-slate-900 hover:text-blue-600">{{ $job->title }}</h3>
                                <p class="text-sm text-slate-600">{{ $job->location }}</p>
                                <p class="mt-2 text-sm text-slate-700">{{ Str::limit($job->description, 150) }}</p>
                            </div>
                            <div class="whitespace-nowrap">
                                <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
                            </div>
                        </div>
                        <div class="mt-3 flex flex-wrap items-center gap-4 border-t pt-3 text-sm">
                            <div>
                                <span class="text-slate-500">Gaji:</span>
                                <span class="ml-1 font-semibold text-slate-900">{{ formatRupiah($job->salary_min) }} - {{ formatRupiah($job->salary_max) }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Kategori:</span>
                                <span class="ml-1 font-semibold text-slate-900">{{ $job->category }}</span>
                            </div>
                            <div class="ml-auto">
                                <span class="text-slate-500 text-xs">Deadline:</span>
                                <span class="ml-1 font-semibold text-slate-900">{{ $job->deadline_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-center">
            <p class="text-slate-600">Belum ada lowongan yang tersedia dari perusahaan ini.</p>
        </div>
    @endif
</div>
@endsection
