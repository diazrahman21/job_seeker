@extends('layouts.app')
@section('content')
<article class="rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-black">{{ $job->title }}</h1>
    <p class="text-slate-500">{{ $job->company->name }} - {{ $job->location }}</p>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <h2 class="font-bold">Deskripsi</h2>
            <p class="text-sm text-slate-700">{{ $job->description }}</p>
            <h2 class="mt-4 font-bold">Requirement</h2>
            <p class="text-sm text-slate-700">{{ $job->requirements }}</p>
        </div>
        <div class="rounded-lg border p-4">
            <p class="text-sm">Tipe: {{ $job->employment_type }}</p>
            <p class="text-sm">Kategori: {{ $job->category }}</p>
            <p class="text-sm">Gaji: {{ $job->salary_min }} - {{ $job->salary_max }}</p>
            @if(!$hasApplied)
            <form method="post" action="{{ route('job-seeker.jobs.apply', $job) }}" enctype="multipart/form-data" class="mt-4 space-y-2">
                @csrf
                <textarea name="cover_letter" placeholder="Cover letter" class="w-full rounded-lg border-slate-300"></textarea>
                <input type="file" name="cv_file" accept="application/pdf" class="w-full rounded-lg border-slate-300">
                <p class="text-xs text-slate-500">Upload CV PDF langsung di sini, atau pilih CV yang sudah pernah diunggah.</p>
                <select name="cv_media_id" class="w-full rounded-lg border-slate-300">
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
                <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Lamar Sekarang</button>
            </form>
            @endif
            <form method="post" action="{{ route('job-seeker.jobs.bookmark', $job) }}" class="mt-2">
                @csrf
                <button class="w-full rounded-lg border py-2">{{ $isBookmarked ? 'Hapus Bookmark' : 'Simpan Bookmark' }}</button>
            </form>
        </div>
    </div>
</article>
@endsection
