@extends('layouts.app')
@section('content')
<article class="rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-black">{{ $job->title }}</h1>
    <p class="text-slate-500"><a href="{{ route('companies.profile', $job->company) }}" class="hover:text-blue-600 hover:underline font-medium text-slate-700">{{ $job->company->name }}</a> - {{ $job->location }}</p>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <h2 class="font-bold">Deskripsi</h2>
            <p class="text-sm text-slate-700">{{ $job->description }}</p>
            <h2 class="mt-4 font-bold">Requirement</h2>
            <p class="text-sm text-slate-700">{{ $job->requirements }}</p>
        </div>
        <div class="rounded-lg border p-4">
            <p class="text-sm">Tipe: <span class="font-semibold">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span></p>
            <p class="text-sm">Kategori: <span class="font-semibold">{{ $job->category }}</span></p>
            <p class="text-sm">Gaji: <span class="font-semibold">{{ formatRupiah($job->salary_min) }} - {{ formatRupiah($job->salary_max) }}</span></p>
            <p class="text-sm mt-2">Deadline: <span class="font-semibold">{{ $job->deadline_at->format('d M Y') }}</span></p>
            @if(!$hasApplied)
            <form method="post" action="{{ route('job-seeker.jobs.apply', $job) }}" enctype="multipart/form-data" class="mt-4 space-y-2">
                @csrf
                <textarea name="cover_letter" placeholder="Cover letter" class="w-full rounded-lg border border-slate-300 px-3 py-2"></textarea>
                <input type="file" name="cv_file" accept="application/pdf" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                <p class="text-xs text-slate-500">Upload CV PDF langsung di sini, atau pilih CV yang sudah pernah diunggah.</p>
                <select name="cv_media_id" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="">Pilih CV yang sudah ada (opsional)</option>
                    @foreach($cvs as $cv)
                        <option value="{{ $cv->id }}">{{ $cv->name }}</option>
                    @endforeach
                </select>
                @error('cv_file')
                    <p class="text-sm text-rose-600">{{ $message }}</p>
                @enderror
                @error('cv_media_id')
                    <p class="text-sm text-rose-600">{{ $message }}</p>
                @enderror
                <button class="w-full rounded-lg bg-slate-900 py-2 text-white font-medium hover:bg-slate-800">Lamar Sekarang</button>
            </form>
            @endif
            <form method="post" action="{{ route('job-seeker.jobs.bookmark', $job) }}" class="mt-2">
                @csrf
                <button class="w-full rounded-lg border py-2 hover:bg-slate-50">{{ $isBookmarked ? 'Hapus Bookmark' : 'Simpan Bookmark' }}</button>
            </form>
        </div>
    </div>
</article>
@endsection
