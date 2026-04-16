@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Dashboard Pelamar</h1>
<div class="mb-4 grid gap-3 md:grid-cols-5">
    @foreach(['applied','review','interview','rejected','hired'] as $st)
        <div class="rounded-lg border bg-white p-3 text-center">
            <p class="text-xs uppercase">{{ $st }}</p>
            <p class="text-xl font-bold">{{ $statusCounts[$st] ?? 0 }}</p>
        </div>
    @endforeach
</div>
<div class="overflow-x-auto rounded-lg border bg-white">
<table class="min-w-full text-sm">
    <thead class="bg-slate-100"><tr><th class="p-3 text-left">Posisi</th><th class="p-3 text-left">Perusahaan</th><th class="p-3 text-left">Status</th></tr></thead>
    <tbody>
    @foreach($applications as $app)
        <tr class="border-t"><td class="p-3">{{ $app->job->title }}</td><td class="p-3">{{ $app->job->company->name }}</td><td class="p-3">{{ strtoupper($app->status) }}</td></tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
