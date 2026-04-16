@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Admin Dashboard</h1>
<div class="grid gap-3 md:grid-cols-5">
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Perusahaan</p><p class="text-2xl font-bold">{{ $totalCompanies }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Pending Company</p><p class="text-2xl font-bold">{{ $pendingCompanies }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Total Jobs</p><p class="text-2xl font-bold">{{ $totalJobs }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Pending Jobs</p><p class="text-2xl font-bold">{{ $pendingJobs }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Pelamar</p><p class="text-2xl font-bold">{{ $totalSeekers }}</p></div>
</div>
@endsection
