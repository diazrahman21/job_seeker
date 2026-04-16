@extends('layouts.admin', ['title' => 'Manajemen Perusahaan'])

@section('content')
<div class="space-y-4">
    <!-- Filter dan Search -->
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <form method="get" class="flex gap-4">
            <input type="text" name="search" placeholder="Cari nama atau email perusahaan..." value="{{ request('search') }}" class="flex-1 rounded border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
            </select>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Cari</button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Nama Perusahaan</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Email</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Lokasi</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Status</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($companies as $company)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4"><a href="{{ route('admin.companies.show', $company->id) }}" class="font-medium text-blue-600 hover:underline">{{ $company->name }}</a></td>
                    <td class="px-6 py-4 text-slate-600">{{ $company->email }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $company->location ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $badgeClass = match($company->status) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'suspended' => 'bg-red-100 text-red-800',
                                default => 'bg-slate-100 text-slate-800'
                            };
                        @endphp
                        <span class="inline-block rounded-full {{ $badgeClass }} px-2 py-1 text-xs font-semibold">{{ ucfirst($company->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.companies.show', $company->id) }}" class="text-blue-600 hover:underline">Detail</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada perusahaan ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">{{ $companies->links() }}</div>
</div>
@endsection
