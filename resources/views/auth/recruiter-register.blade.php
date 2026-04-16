@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md rounded-2xl border border-gray-200 bg-white p-8 shadow-md">
    <h1 class="text-3xl font-bold text-gray-900">Register Perusahaan</h1>
    <form method="post" action="{{ route('recruiter.register') }}" class="mt-6 space-y-4">
        @csrf
        <input name="name" placeholder="Nama Perusahaan" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input name="email" type="email" placeholder="Email" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input name="website" placeholder="Website" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input name="location" placeholder="Lokasi" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <textarea name="description" placeholder="Deskripsi" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        <input name="password" type="password" placeholder="Password" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <button class="w-full rounded-lg bg-blue-600 py-3 text-white font-semibold hover:bg-blue-700 transition-colors">Daftar Perusahaan</button>
    </form>
</div>
@endsection
