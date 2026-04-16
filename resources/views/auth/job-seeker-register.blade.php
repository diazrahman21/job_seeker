@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-bold">Daftar Pelamar</h1>

    <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
        Setelah daftar, akun wajib verifikasi OTP terlebih dahulu sebelum bisa login penuh dan melamar kerja.
    </div>

    <div class="mt-4 space-y-2">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-slate-300 py-2 text-sm font-medium hover:bg-slate-50">
            <span>Lanjut dengan Google</span>
        </a>
        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-slate-300 py-2 text-sm font-medium hover:bg-slate-50">
            <span>Lanjut dengan Facebook</span>
        </a>
    </div>

    <div class="my-4 text-center text-xs uppercase tracking-wide text-slate-400">atau</div>

    <form method="post" action="{{ route('job-seeker.register') }}" class="mt-4 space-y-3">
        @csrf
        <input name="name" placeholder="Nama" class="w-full rounded-lg border-slate-300" required>
        <input name="email" type="email" placeholder="Email" class="w-full rounded-lg border-slate-300" required>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-lg border-slate-300" required>
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full rounded-lg border-slate-300" required>
        <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Daftar</button>
    </form>
</div>
@endsection
