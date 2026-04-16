@extends('layouts.admin', ['title' => 'Laporan & Analytics'])
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-900">Laporan Analytics</h2>
        <a href="{{ route('admin.reports.export') }}" class="rounded bg-green-600 px-4 py-2 text-sm font-medium text-white">📥 Export CSV</a>
    </div>

    @if($topJobs->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white p-6">
        <h3 class="font-semibold text-slate-900">Lowongan Teratas (Paling Banyak Dilamar)</h3>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead><tr class="border-b"><th class="px-4 py-2 text-left">Judul</th><th class="px-4 py-2 text-left">Perusahaan</th><th class="px-4 py-2 text-right">Lamaran</th></tr></thead>
                <tbody>
                    @foreach($topJobs as $job)
                    <tr class="border-b hover:bg-slate-50"><td class="px-4 py-2">{{ $job->title }}</td><td class="px-4 py-2">{{ $job->company->name }}</td><td class="px-4 py-2 text-right font-semibold">{{ $job->applications_count ?? 0 }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($topCompanies->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white p-6">
        <h3 class="font-semibold text-slate-900">Perusahaan Teratas</h3>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead><tr class="border-b"><th class="px-4 py-2 text-left">Nama</th><th class="px-4 py-2 text-center">Lowongan</th></tr></thead>
                <tbody>
                    @foreach($topCompanies as $company)
                    <tr class="border-b hover:bg-slate-50"><td class="px-4 py-2">{{ $company->name }}</td><td class="px-4 py-2 text-center">{{ $company->jobs_count ?? 0 }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($topUsers->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white p-6">
        <h3 class="font-semibold text-slate-900">Pencari Kerja Teratas</h3>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead><tr class="border-b"><th class="px-4 py-2 text-left">Nama</th><th class="px-4 py-2 text-right">Lamaran</th></tr></thead>
                <tbody>
                    @foreach($topUsers as $user)
                    <tr class="border-b hover:bg-slate-50"><td class="px-4 py-2">{{ $user->name }}</td><td class="px-4 py-2 text-right font-semibold">{{ $user->applications_count ?? 0 }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
