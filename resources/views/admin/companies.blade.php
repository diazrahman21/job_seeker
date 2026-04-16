@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Moderasi Perusahaan</h1>
<div class="space-y-4">
@foreach($companies as $company)
    <div class="rounded-lg border bg-white p-6">
        <div class="flex flex-col gap-4">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="flex-1">
                    <p class="text-lg font-semibold text-slate-900">{{ $company->name }}</p>
                    <p class="text-sm text-slate-600 mt-1">{{ $company->email }}</p>
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="text-sm text-blue-600 hover:underline">{{ $company->website }}</a>
                    @endif
                </div>
                <form method="post" action="{{ route('admin.companies.status', $company) }}" class="flex gap-2">@csrf @method('put')
                    <select name="status" class="rounded border border-slate-300 px-3 py-2 text-sm">
                        @foreach(['pending','approved','rejected'] as $s)
                            <option value="{{ $s }}" @selected($company->status === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="rounded bg-slate-900 px-4 py-2 text-white text-sm font-medium hover:bg-slate-800">Update</button>
                </form>
            </div>

            <div class="border-t pt-4">
                <p class="text-sm font-medium text-slate-700 mb-2">Profil Perusahaan:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                    <div>
                        <p class="text-slate-500">Lokasi</p>
                        <p class="font-medium text-slate-900">{{ $company->location ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Industri</p>
                        <p class="font-medium text-slate-900">{{ $company->industry ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Ukuran</p>
                        <p class="font-medium text-slate-900">{{ $company->company_size ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Tahun Berdiri</p>
                        <p class="font-medium text-slate-900">{{ $company->founded_year ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($company->description)
                <div class="border-t pt-4">
                    <p class="text-sm font-medium text-slate-700 mb-2">Deskripsi:</p>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ Str::limit($company->description, 300) }}</p>
                </div>
            @endif

            @if($company->phone)
                <div class="border-t pt-4 text-sm">
                    <p class="text-slate-500">Telepon: <span class="font-medium text-slate-900">{{ $company->phone }}</span></p>
                </div>
            @endif
        </div>
    </div>
@endforeach
</div>
@endsection
