@extends('layouts.admin', ['title' => 'Manajemen Lowongan'])
@section('content')
<div class="space-y-4">
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <form method="get" class="flex gap-4 flex-wrap">
            <input type="text" name="search" placeholder="Cari judul lowongan..." value="{{ request('search') }}" class="flex-1 min-w-64 rounded border border-slate-300 px-3 py-2 text-sm">
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <label class="flex items-center gap-2 rounded border border-slate-300 px-3 py-2 cursor-pointer">
                <input type="checkbox" name="include_deleted" value="1" {{ request('include_deleted') ? 'checked' : '' }} class="rounded">
                <span class="text-sm">Termasuk Dihapus</span>
            </label>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Judul</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Perusahaan</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Status</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Unggulan</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($jobs as $job)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4"><a href="{{ route('admin.jobs.show', $job->id) }}" class="font-medium text-blue-600 hover:underline">{{ $job->title }}</a></td>
                    <td class="px-6 py-4 text-slate-600">{{ $job->company->name }}</td>
                    <td class="px-6 py-4 text-center">
                        @php $badgeClass = match($job->status) { 'pending' => 'bg-yellow-100 text-yellow-800', 'approved' => 'bg-green-100 text-green-800', 'rejected' => 'bg-red-100 text-red-800', default => 'bg-slate-100 text-slate-800' }; @endphp
                        <span class="inline-block rounded-full {{ $badgeClass }} px-2 py-1 text-xs font-semibold">{{ ucfirst($job->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($job->is_featured)
                            <span class="inline-block rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">⭐ Unggulan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.jobs.show', $job->id) }}" class="text-blue-600 hover:underline">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada lowongan ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">{{ $jobs->links() }}</div>
</div>
@endsection
