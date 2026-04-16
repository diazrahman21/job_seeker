@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-bold">Login Pelamar</h1>

    <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
        OTP verification membutuhkan SMTP aktif agar kode OTP bisa dikirim ke email.
    </div>

    <form method="post" action="{{ route('job-seeker.login') }}" class="mt-4 space-y-3">
        @csrf
        <input name="email" type="email" placeholder="Email" class="w-full rounded-lg border-slate-300" required>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-lg border-slate-300" required>
        <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Masuk</button>
    </form>
</div>
@endsection
