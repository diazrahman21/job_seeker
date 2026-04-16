@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-bold">Login Pelamar</h1>
    <p class="mt-1 text-sm text-slate-600">Halaman ini kompatibel dengan route bawaan Laravel/Fortify.</p>

    <form method="post" action="{{ route('job-seeker.login') }}" class="mt-4 space-y-3">
        @csrf
        <input name="email" type="email" placeholder="Email" class="w-full rounded-lg border-slate-300" required>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-lg border-slate-300" required>
        <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Masuk</button>
    </form>

    <div class="mt-4 space-y-2 text-sm">
        <p>Belum punya akun? <a class="font-semibold text-indigo-600" href="{{ route('job-seeker.register') }}">Daftar pelamar</a></p>
        <p>Perusahaan? <a class="font-semibold text-indigo-600" href="{{ route('recruiter.login') }}">Login recruiter</a></p>
    </div>
</div>
@endsection
