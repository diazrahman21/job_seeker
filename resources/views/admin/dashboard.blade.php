@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pencari Kerja -->
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Pencari Kerja</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalSeekers }}</p>
                </div>
                <x-icon name="users" class="w-12 h-12 text-blue-200" />
            </div>
        </x-card>

        <!-- Total Perusahaan -->
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Perusahaan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalRecruiters }}</p>
                </div>
                <x-icon name="building-office-2" class="w-12 h-12 text-blue-200" />
            </div>
        </x-card>

        <!-- Total Lowongan -->
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Lowongan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalJobs }}</p>
                </div>
                <x-icon name="briefcase" class="w-12 h-12 text-blue-200" />
            </div>
        </x-card>

        <!-- Total Lamaran -->
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Lamaran</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalApplications }}</p>
                </div>
                <x-icon name="document-text" class="w-12 h-12 text-blue-200" />
            </div>
        </x-card>
    </div>

    <!-- Status Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Status Lowongan -->
        <x-card title="Status Lowongan">
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <x-icon name="check-circle" class="w-5 h-5" />
                        Aktif (Disetujui)
                    </span>
                    <x-badge status="approved">{{ $activeJobs }}</x-badge>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <x-icon name="x-circle" class="w-5 h-5" />
                        Tidak Aktif
                    </span>
                    <x-badge status="rejected">{{ $inactiveJobs }}</x-badge>
                </div>
            </div>
        </x-card>

        <!-- Menunggu Persetujuan -->
        <x-card title="Menunggu Persetujuan">
            <div class="space-y-3">
                <a href="{{ route('admin.companies', ['status' => 'pending']) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-yellow-50 transition-colors">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <x-icon name="building-office-2" class="w-5 h-5" />
                        Perusahaan Pending
                    </span>
                    <x-badge status="pending">{{ $pendingCompanies }}</x-badge>
                </a>
                <a href="{{ route('admin.jobs', ['status' => 'pending']) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-yellow-50 transition-colors">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <x-icon name="document-text" class="w-5 h-5" />
                        Lowongan Pending
                    </span>
                    <x-badge status="pending">{{ $pendingJobs }}</x-badge>
                </a>
            </div>
        </x-card>
    </div>

    <!-- Popular Jobs Section -->
    @if($popularJobs->count() > 0)
    <x-card title="Lowongan Populer (5 Teratas)">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Judul</th>
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Perusahaan</th>
                        <th class="pb-3 px-4 text-right font-semibold text-slate-600">Lamaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popularJobs as $job)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.jobs.show', $job->id) }}" class="font-medium text-blue-600 hover:text-blue-700 no-underline">
                                {{ Str::limit($job->title, 40) }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-slate-600">{{ $job->company->name }}</td>
                        <td class="py-3 px-4 text-right font-medium">{{ $job->applications_count ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
    @else
    <x-empty-state title="Belum Ada Data Lowongan" description="Tidak ada lowongan yang ditampilkan saat ini" icon="briefcase" />
    @endif
</div>
@endsection
