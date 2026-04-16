@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-4 gap-4">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Pencari Kerja</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalSeekers }}</p>
                </div>
                <svg class="h-12 w-12 text-blue-200" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Perusahaan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalRecruiters }}</p>
                </div>
                <svg class="h-12 w-12 text-green-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Lowongan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalJobs }}</p>
                </div>
                <svg class="h-12 w-12 text-purple-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a2 2 0 002 2v6a2 2 0 002 2h8a2 2 0 002-2v-6a2 2 0 002-2V7a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 104 0 2 2 0 00-4 0z" clip-rule="evenodd"/></svg>
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Lamaran</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalApplications }}</p>
                </div>
                <svg class="h-12 w-12 text-orange-200" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H5a1 1 0 000 2h-.5A1.5 1.5 0 004 8v10a1.5 1.5 0 001.5 1.5h9A1.5 1.5 0 0016 18V8a1.5 1.5 0 00-1.5-1.5H14a1 1 0 100-2h.5A2 2 0 0116 5v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" clip-rule="evenodd"/></svg>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="grid grid-cols-2 gap-4">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-semibold text-slate-900">Status Lowongan</h3>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Aktif (Disetujui)</span>
                    <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-800">{{ $activeJobs }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Tidak Aktif</span>
                    <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-800">{{ $inactiveJobs }}</span>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-semibold text-slate-900">Menunggu Persetujuan</h3>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Perusahaan Pending</span>
                    <a href="{{ route('admin.companies', ['status' => 'pending']) }}" class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-800 hover:bg-yellow-200">{{ $pendingCompanies }}</a>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Lowongan Pending</span>
                    <a href="{{ route('admin.jobs', ['status' => 'pending']) }}" class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-800 hover:bg-yellow-200">{{ $pendingJobs }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Jobs -->
    @if($popularJobs->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="font-semibold text-slate-900">Lowongan Populer (5 Teratas)</h3>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="pb-3 text-left font-semibold text-slate-600">Judul Lowongan</th>
                        <th class="pb-3 text-left font-semibold text-slate-600">Perusahaan</th>
                        <th class="pb-3 text-right font-semibold text-slate-600">Jumlah Lamaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popularJobs as $job)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="py-3">
                            <a href="{{ route('admin.jobs.show', $job->id) }}" class="font-medium text-blue-600 hover:underline">{{ $job->title }}</a>
                        </td>
                        <td class="py-3">{{ $job->company->name }}</td>
                        <td class="py-3 text-right">{{ $job->applications_count ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
