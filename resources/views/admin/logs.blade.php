@extends('layouts.admin', ['title' => 'Log Aktivitas Admin'])
@section('content')
<div class="space-y-4">
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <form method="get" class="flex gap-4">
            <input type="text" name="action" placeholder="Cari aksi..." value="{{ request('action') }}" class="flex-1 rounded border border-slate-300 px-3 py-2 text-sm">
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Admin</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Aksi</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Target</th>
                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($logs as $log)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $log->admin->name }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $log->action }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $log->target_type ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $log->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-4 text-center text-slate-500">Tidak ada log ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">{{ $logs->links() }}</div>
</div>
@endsection
