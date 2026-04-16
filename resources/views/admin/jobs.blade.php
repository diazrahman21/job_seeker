@extends('layouts.admin', ['title' => 'Manajemen Lowongan'])

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Daftar Lowongan</h2>
            <p class="text-slate-500 mt-1">Kelola dan moderasi semua lowongan kerja</p>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <x-card title="Filter & Pencarian">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-input 
                    name="search" 
                    label="Cari Lowongan"
                    placeholder="Judul lowongan..." 
                    value="{{ request('search') }}" 
                />
                <x-input 
                    name="status" 
                    label="Status"
                    type="select"
                    value="{{ request('status') }}"
                >
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </x-input>
                <div class="flex items-end gap-2">
                    <label class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="include_deleted" value="1" {{ request('include_deleted') ? 'checked' : '' }} class="rounded accent-blue-600">
                        <span class="text-sm font-medium text-slate-700">Termasuk Dihapus</span>
                    </label>
                </div>
                <div class="flex items-end gap-2">
                    <x-button type="submit" variant="primary" class="flex-1">
                        <span class="flex items-center gap-2 justify-center">
                            <x-icon name="magnifying-glass" class="w-5 h-5" />
                            Cari
                        </span>
                    </x-button>
                    <a href="{{ route('admin.jobs') }}" class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium text-center no-underline">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </x-card>

    <!-- Jobs Table Card -->
    @if($jobs->count() > 0)
    <x-card title="Data Lowongan">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Lowongan</th>
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Perusahaan</th>
                        <th class="pb-3 px-4 text-center font-semibold text-slate-600">Status</th>
                        <th class="pb-3 px-4 text-center font-semibold text-slate-600">Unggulan</th>
                        <th class="pb-3 px-4 text-center font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <div>
                                <a href="{{ route('admin.jobs.show', $job->id) }}" class="font-semibold text-blue-600 hover:text-blue-700 no-underline">
                                    {{ Str::limit($job->title, 45) }}
                                </a>
                                <p class="text-xs text-slate-500 mt-1">{{ $job->location ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            {{ $job->company->name }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @php
                                $statusMap = [
                                    'pending' => 'pending',
                                    'approved' => 'approved',
                                    'rejected' => 'rejected',
                                ];
                            @endphp
                            <x-badge status="{{ $statusMap[$job->status] ?? 'default' }}">
                                {{ ucfirst($job->status) }}
                            </x-badge>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($job->is_featured)
                                <x-badge status="approved">⭐ Unggulan</x-badge>
                            @else
                                <span class="text-xs text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.jobs.show', $job->id) }}" class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium no-underline">
                                Lihat →
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            {{ $jobs->links() }}
        </div>
    </x-card>
    @else
    <x-empty-state 
        title="Tidak Ada Lowongan"
        description="Belum ada lowongan yang terdaftar di sistem"
        icon="briefcase"
    />
    @endif
</div>
@endsection
