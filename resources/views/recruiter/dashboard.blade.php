@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Dashboard Rekruter</h1>
<div class="grid gap-3 md:grid-cols-3">
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Total Posting</p><p class="text-2xl font-bold">{{ $totalPostings }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Total Pelamar</p><p class="text-2xl font-bold">{{ $totalApplicants }}</p></div>
    <div class="rounded-lg border bg-white p-4"><p class="text-sm">Lowongan Aktif</p><p class="text-2xl font-bold">{{ $activeJobs }}</p></div>
</div>
@endsection
