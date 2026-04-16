@extends('layouts.app')

@section('content')
<section class="rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-700 p-8 text-white md:p-12">
    <div class="grid gap-8 md:grid-cols-2">
        <div>
            <p class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-bold tracking-wide">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487 18 3.375l2.625 2.625-1.112 1.138m-2.651-1.513L7.5 15.375V18h2.625l9.362-9.375m-9.362 9.375L6.375 20.625M18 3.375 20.625 6" /></svg>
                Recruitment Platform
            </p>
            <h1 class="text-3xl font-black leading-tight md:text-5xl">Job Board & Recruitment App</h1>
            <p class="mt-4 max-w-xl text-white/90">Portal pelamar, rekruter, dan admin dalam satu aplikasi Laravel 12 dengan Livewire real-time filtering dan notifikasi otomatis.</p>
        </div>
        <div class="grid gap-3 self-end">
            <a href="{{ route('job-seeker.login') }}" class="rounded-xl bg-white px-4 py-3 text-center font-semibold text-blue-700">Masuk Pelamar</a>
            <a href="{{ route('job-seeker.register') }}" class="rounded-xl bg-slate-900/30 px-4 py-3 text-center font-semibold">Daftar Pelamar</a>
            <a href="{{ route('recruiter.login') }}" class="rounded-xl bg-white px-4 py-3 text-center font-semibold text-blue-700">Masuk Rekruter</a>
            <a href="{{ route('recruiter.register') }}" class="rounded-xl bg-slate-900/30 px-4 py-3 text-center font-semibold">Daftar Perusahaan</a>
            <a href="{{ route('admin.login') }}" class="rounded-xl border border-white/60 px-4 py-3 text-center font-semibold">Masuk Admin</a>
        </div>
    </div>
</section>
@endsection
