@extends('layouts.admin', ['title' => 'Detail Lowongan'])
@section('content')
<div class="rounded-lg border border-slate-200 bg-white p-6">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">{{ $job->title }}</h2>
            <p class="mt-2 text-slate-600">{{ $job->company->name }}</p>
        </div>
        <div class="flex gap-2">
            <form method="post" action="{{ route('admin.jobs.featured', $job->id) }}" class="inline">
                @csrf @method('put')
                <button type="submit" class="rounded {{ $job->is_featured ? 'bg-blue-600 text-white' : 'border border-slate-300 text-slate-900' }} px-4 py-2 text-sm font-medium">
                    {{ $job->is_featured ? '⭐ Unggulan' : 'Jadikan Unggulan' }}
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6 border-b pb-6">
        <div>
            <p class="text-sm font-medium text-slate-600">Lokasi</p>
            <p class="mt-1 text-slate-900">{{ $job->location }}</p>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-600">Tipe Pekerjaan</p>
            <p class="mt-1 text-slate-900">{{ $job->employment_type }}</p>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-600">Kategori</p>
            <p class="mt-1 text-slate-900">{{ $job->category }}</p>
        </div>
    </div>

    <div class="mt-6">
        <form method="post" action="{{ route('admin.jobs.status', $job->id) }}" class="mb-6">
            @csrf @method('put')
            <div class="flex gap-2">
                <select name="status" class="rounded border border-slate-300 px-3 py-2">
                    <option value="pending" {{ $job->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $job->status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ $job->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Update Status</button>
            </div>
        </form>
    </div>

    @if($job->description)
    <div class="border-t pt-6">
        <p class="font-medium text-slate-900">Deskripsi</p>
        <p class="mt-2 text-slate-700">{{ $job->description }}</p>
    </div>
    @endif

    @if($job->applications->count() > 0)
    <div class="mt-6 border-t pt-6">
        <p class="font-medium text-slate-900">Lamaran ({{ $job->applications->count() }})</p>
        <div class="mt-4 space-y-2">
            @foreach($job->applications as $app)
            <a href="{{ route('admin.applications') }}" class="block rounded border border-slate-200 p-3 text-slate-700 hover:bg-slate-50">{{ $app->user->name }}</a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-6 border-t pt-6 flex gap-2">
        <form method="post" action="{{ route('admin.jobs.delete', $job->id) }}" onsubmit="return confirm('Hapus lowongan ini?')" class="inline">
            @csrf @method('delete')
            <button class="text-red-600 hover:underline">Hapus</button>
        </form>
        <a href="{{ route('admin.jobs') }}" class="text-blue-600 hover:underline">← Kembali</a>
    </div>
</div>
@endsection
