@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pencari Kerja -->
        <x-stat-card 
            title="Total Pencari Kerja"
            value="{{ $totalSeekers }}"
            icon="users"
        />

        <!-- Total Perusahaan -->
        <x-stat-card 
            title="Total Perusahaan"
            value="{{ $totalRecruiters }}"
            icon="building-office-2"
        />

        <!-- Total Lowongan -->
        <x-stat-card 
            title="Total Lowongan"
            value="{{ $totalJobs }}"
            icon="briefcase"
        />

        <!-- Total Lamaran -->
        <x-stat-card 
            title="Total Lamaran"
            value="{{ $totalApplications }}"
            icon="document-text"
        />
    </div>

    <!-- Status Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Status Lowongan -->
        <x-card title="Status Lowongan">
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-green-50 transition-all duration-200 border border-gray-100 hover:border-green-200">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <x-icon name="check-circle" class="w-5 h-5 text-green-600" />
                        Aktif (Disetujui)
                    </span>
                    <span class="font-bold text-slate-900">{{ $activeJobs }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-red-50 transition-all duration-200 border border-gray-100 hover:border-red-200">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <x-icon name="x-circle" class="w-5 h-5 text-red-600" />
                        Tidak Aktif
                    </span>
                    <span class="font-bold text-slate-900">{{ $inactiveJobs }}</span>
                </div>
            </div>
        </x-card>

        <!-- Menunggu Persetujuan -->
        <x-card title="Menunggu Persetujuan">
            <div class="space-y-3">
                <a href="{{ route('admin.companies', ['status' => 'pending']) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-yellow-50 transition-all duration-200 border border-gray-100 hover:border-yellow-200">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <x-icon name="building-office-2" class="w-5 h-5 text-yellow-600" />
                        Perusahaan Pending
                    </span>
                    <x-badge status="pending">{{ $pendingCompanies }}</x-badge>
                </a>
                <a href="{{ route('admin.jobs', ['status' => 'pending']) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-yellow-50 transition-all duration-200 border border-gray-100 hover:border-yellow-200">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <x-icon name="document-text" class="w-5 h-5 text-yellow-600" />
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
                        <th class="pb-3 px-4 text-left font-semibold text-slate-700">Judul</th>
                        <th class="pb-3 px-4 text-left font-semibold text-slate-700">Perusahaan</th>
                        <th class="pb-3 px-4 text-right font-semibold text-slate-700">Lamaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popularJobs as $job)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-200">
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.jobs', $job->id) }}" class="font-medium text-blue-600 hover:text-blue-700 no-underline transition-colors">
                                {{ Str::limit($job->title, 40) }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-slate-700">{{ $job->company->name }}</td>
                        <td class="py-3 px-4 text-right font-bold text-slate-900">{{ $job->applications_count ?? 0 }}</td>
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
