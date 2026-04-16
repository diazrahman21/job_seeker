@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Bookmark Lowongan</h1>
<div class="grid gap-3">
    @forelse($jobs as $job)
        <a href="{{ route('job-seeker.jobs.detail', $job) }}" class="rounded-lg border border-slate-200 bg-white p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                    <p class="text-sm text-slate-500"><a href="{{ route('companies.profile', $job->company) }}" class="hover:text-blue-600 hover:underline" onclick="event.stopPropagation()">{{ $job->company->name }}</a> - {{ $job->location }}</p>
                    <p class="text-sm text-slate-600 mt-2">Gaji: <span class="font-semibold">{{ formatRupiah($job->salary_min) }} - {{ formatRupiah($job->salary_max) }}</span></p>
                </div>
                <span class="whitespace-nowrap text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
            </div>
        </a>
    @empty
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-6 text-center">
            <p class="text-slate-600">Belum ada bookmark. Mulai cari lowongan dan bookmark yang kamu sukai!</p>
        </div>
    @endforelse
</div>
@endsection
