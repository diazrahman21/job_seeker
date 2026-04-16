@extends('layouts.admin', ['title' => 'Manajemen Lamaran'])
@section('content')
<div class="space-y-4">
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <form method="get" class="flex gap-4 flex-wrap">
            <input type="text" name="search" placeholder="Cari nama pelamar atau judul..." value="{{ request('search') }}" class="flex-1 min-w-64 rounded border border-slate-300 px-3 py-2 text-sm">
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="applied" {{ request('status') === 'applied' ? 'selected' : '' }}>Dilamar</option>
                <option value="interview" {{ request('status') === 'interview' ? 'selected' : '' }}>Wawancara</option>
                <option value="hired" {{ request('status') === 'hired' ? 'selected' : '' }}>Diterima</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Pelamar</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Lowongan</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Status</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Tanggal Lamar</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($applications as $app)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4"><a href="{{ route('admin.users.show', $app->user->id) }}" class="font-medium text-blue-600 hover:underline">{{ $app->user->name }}</a></td>
                    <td class="px-6 py-4 text-slate-600">{{ $app->job->title }}</td>
                    <td class="px-6 py-4 text-center">
                        @php 
                        $badgeClass = match($app->status) {
                            'applied' => 'bg-blue-100 text-blue-800',
                            'interview' => 'bg-purple-100 text-purple-800',
                            'hired' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            default => 'bg-slate-100 text-slate-800'
                        };
                        @endphp
                        <span class="inline-block rounded-full {{ $badgeClass }} px-2 py-1 text-xs font-semibold">{{ ucfirst($app->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center text-slate-600">{{ $app->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.applications.cv', $app->id) }}" class="text-blue-600 hover:underline" download>Download CV</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada lamaran ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">{{ $applications->links() }}</div>
</div>
@endsection
