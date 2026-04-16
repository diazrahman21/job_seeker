@extends('layouts.admin', ['title' => 'Manajemen Perusahaan'])

@section('content')
<div class="space-y-6">
    <!-- Header dengan Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Daftar Perusahaan</h2>
            <p class="text-slate-500 mt-1">Kelola dan moderasi semua perusahaan yang terdaftar</p>
        </div>
    </div>

    <!-- Filter dan Search Card -->
    <x-card title="Filter & Pencarian">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-input 
                    name="search" 
                    label="Cari Perusahaan"
                    placeholder="Nama atau email..." 
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
                    <option value="suspended">Ditangguhkan</option>
                </x-input>
                <div class="flex items-end gap-2">
                    <x-button type="submit" variant="primary" class="flex-1">
                        <span class="flex items-center gap-2 justify-center">
                            <x-icon name="magnifying-glass" class="w-5 h-5" />
                            Cari
                        </span>
                    </x-button>
                    <a href="{{ route('admin.companies') }}" class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium text-center no-underline">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </x-card>

    <!-- Companies Table Card -->
    @if($companies->count() > 0)
    <x-card title="Data Perusahaan">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Perusahaan</th>
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Kontak</th>
                        <th class="pb-3 px-4 text-left font-semibold text-slate-600">Lokasi</th>
                        <th class="pb-3 px-4 text-center font-semibold text-slate-600">Status</th>
                        <th class="pb-3 px-4 text-center font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <div>
                                <a href="{{ route('admin.companies.show', $company->id) }}" class="font-semibold text-blue-600 hover:text-blue-700 no-underline">
                                    {{ $company->name }}
                                </a>
                                <p class="text-xs text-slate-500 mt-1">ID: {{ $company->id }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-sm">
                                <p class="text-slate-900">{{ $company->email }}</p>
                                <p class="text-slate-500">{{ $company->phone ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-slate-600">{{ $company->location ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            @php
                                $statusMap = [
                                    'pending' => 'pending',
                                    'approved' => 'approved',
                                    'rejected' => 'rejected',
                                    'suspended' => 'suspended',
                                ];
                            @endphp
                            <x-badge status="{{ $statusMap[$company->status] ?? 'default' }}">
                                {{ ucfirst($company->status) }}
                            </x-badge>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.companies.show', $company->id) }}" class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium no-underline">
                                Lihat Detail →
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            {{ $companies->links() }}
        </div>
    </x-card>
    @else
    <x-empty-state 
        title="Tidak Ada Perusahaan"
        description="Belum ada perusahaan yang terdaftar di sistem"
        icon="briefcase"
    />
    @endif
</div>
@endsection
