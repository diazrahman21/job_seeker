@extends('layouts.admin', ['title' => 'Detail Pencari Kerja'])
@section('content')
<div class="rounded-lg border border-slate-200 bg-white p-6">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h2>
            <p class="mt-2 text-slate-600">{{ $user->email }}</p>
        </div>
        <form method="post" action="{{ route('admin.users.status', $user->id) }}" class="flex gap-2">
            @csrf @method('put')
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
            </select>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Update</button>
        </form>
    </div>

    <div class="grid grid-cols-2 gap-6 border-b pb-6">
        <div>
            <p class="text-sm font-medium text-slate-600">Judul</p>
            <p class="mt-1 text-slate-900">{{ $user->title ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-600">Lokasi</p>
            <p class="mt-1 text-slate-900">{{ $user->location ?? '-' }}</p>
        </div>
    </div>

    @if($user->bio)
    <div class="mt-6">
        <p class="font-medium text-slate-900">Bio</p>
        <p class="mt-2 text-slate-700">{{ $user->bio }}</p>
    </div>
    @endif

    @if($user->experiences->count() > 0)
    <div class="mt-6 border-t pt-6">
        <p class="font-medium text-slate-900">Pengalaman ({{ $user->experiences->count() }})</p>
        <div class="mt-4 space-y-3">
            @foreach($user->experiences as $exp)
            <div class="rounded border border-slate-200 p-3">
                <p class="font-medium text-slate-900">{{ $exp->job_title }}</p>
                <p class="text-sm text-slate-600">{{ $exp->company_name }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($user->applications->count() > 0)
    <div class="mt-6 border-t pt-6">
        <p class="font-medium text-slate-900">Lamaran ({{ $user->applications->count() }})</p>
        <div class="mt-4 space-y-2">
            @foreach($user->applications as $app)
            <div class="rounded border border-slate-200 p-3 text-slate-700">{{ $app->job->title }}</div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-6 border-t pt-6 flex gap-2">
        <form method="post" action="{{ route('admin.users.delete', $user->id) }}" onsubmit="return confirm('Hapus pengguna ini?')" class="inline">
            @csrf @method('delete')
            <button class="text-red-600 hover:underline">Hapus</button>
        </form>
        <a href="{{ route('admin.users') }}" class="text-blue-600 hover:underline">← Kembali</a>
    </div>
</div>
@endsection
