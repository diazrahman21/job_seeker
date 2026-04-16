@extends('layouts.admin', ['title' => 'Manajemen Pencari Kerja'])
@section('content')
<div class="space-y-4">
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <form method="get" class="flex gap-4 flex-wrap">
            <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" class="flex-1 min-w-64 rounded border border-slate-300 px-3 py-2 text-sm">
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
            </select>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Email</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Status</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Lamaran</th>
                    <th class="px-6 py-3 text-center font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4"><a href="{{ route('admin.users.show', $user->id) }}" class="font-medium text-blue-600 hover:underline">{{ $user->name }}</a></td>
                    <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center">
                        @php $badgeClass = $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; @endphp
                        <span class="inline-block rounded-full {{ $badgeClass }} px-2 py-1 text-xs font-semibold">{{ ucfirst($user->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">{{ $user->applications_count ?? 0 }}</td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:underline">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada pencari kerja ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">{{ $users->links() }}</div>
</div>
@endsection
