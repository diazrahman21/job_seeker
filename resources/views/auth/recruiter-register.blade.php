@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-bold">Register Perusahaan</h1>
    <form method="post" action="{{ route('recruiter.register') }}" class="mt-4 space-y-3">
        @csrf
        <input name="name" placeholder="Nama Perusahaan" class="w-full rounded-lg border-slate-300" required>
        <input name="email" type="email" placeholder="Email" class="w-full rounded-lg border-slate-300" required>
        <input name="website" placeholder="Website" class="w-full rounded-lg border-slate-300">
        <input name="location" placeholder="Lokasi" class="w-full rounded-lg border-slate-300">
        <textarea name="description" placeholder="Deskripsi" class="w-full rounded-lg border-slate-300"></textarea>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-lg border-slate-300" required>
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full rounded-lg border-slate-300" required>
        <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Daftar Perusahaan</button>
    </form>
</div>
@endsection
