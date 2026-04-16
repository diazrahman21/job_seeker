@extends('layouts.admin', ['title' => 'Detail Perusahaan'])
@section('content')
<div class="rounded-lg border border-slate-200 bg-white p-6">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">{{ $company->name }}</h2>
            <p class="mt-2 text-slate-600">{{ $company->email }}</p>
        </div>
        <form method="post" action="{{ route('admin.companies.status', $company->id) }}" class="flex gap-2">
            @csrf @method('put')
            <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                <option value="pending" {{ $company->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $company->status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ $company->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                <option value="suspended" {{ $company->status === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
            </select>
            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white">Update</button>
        </form>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div>
            <p class="text-sm font-medium text-slate-600">Lokasi</p>
            <p class="mt-1 text-slate-900">{{ $company->location ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-600">Website</p>
            <p class="mt-1"><a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $company->website ?? '-' }}</a></p>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-600">Industri</p>
            <p class="mt-1 text-slate-900">{{ $company->industry ?? '-' }}</p>
        </div>
    </div>

    @if($company->description)
    <div class="mt-6 border-t pt-6">
        <p class="font-medium text-slate-900">Deskripsi</p>
        <p class="mt-2 text-slate-700">{{ $company->description }}</p>
    </div>
    @endif

    @if($company->jobs->count() > 0)
    <div class="mt-6 border-t pt-6">
        <h3 class="font-semibold text-slate-900">Lowongan Aktif ({{ $company->jobs->count() }})</h3>
        <div class="mt-4 space-y-2">
            @foreach($company->jobs as $job)
            <a href="{{ route('admin.jobs.show', $job->id) }}" class="block rounded border border-slate-200 p-3 text-blue-600 hover:bg-slate-50">{{ $job->title }}</a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-6 border-t pt-6">
        <a href="{{ route('admin.companies') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Perusahaan</a>
    </div>
</div>
@endsection
