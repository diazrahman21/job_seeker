@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">{{ $job->exists ? 'Edit' : 'Tambah' }} Lowongan</h1>
<form method="post" action="{{ $job->exists ? route('recruiter.jobs.update', $job) : route('recruiter.jobs.store') }}" class="grid gap-3 rounded-xl border bg-white p-4">
    @csrf
    @if($job->exists) @method('put') @endif
    <input name="title" value="{{ old('title', $job->title) }}" placeholder="Judul" class="rounded-lg border-slate-300" required>
    <textarea name="description" placeholder="Deskripsi" class="rounded-lg border-slate-300" required>{{ old('description', $job->description) }}</textarea>
    <textarea name="requirements" placeholder="Requirements" class="rounded-lg border-slate-300" required>{{ old('requirements', $job->requirements) }}</textarea>
    <div class="grid gap-3 md:grid-cols-3">
        <input name="location" value="{{ old('location', $job->location) }}" placeholder="Lokasi" class="rounded-lg border-slate-300" required>
        <input name="category" value="{{ old('category', $job->category) }}" placeholder="Kategori" class="rounded-lg border-slate-300" required>
        <select name="employment_type" class="rounded-lg border-slate-300" required>
            @foreach(['full-time','part-time','contract','internship'] as $type)
                <option value="{{ $type }}" @selected(old('employment_type', $job->employment_type) === $type)>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid gap-3 md:grid-cols-3">
        <input type="number" step="0.01" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}" placeholder="Gaji Min" class="rounded-lg border-slate-300">
        <input type="number" step="0.01" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}" placeholder="Gaji Max" class="rounded-lg border-slate-300">
        <input type="date" name="deadline_at" value="{{ old('deadline_at', optional($job->deadline_at)->format('Y-m-d')) }}" class="rounded-lg border-slate-300" required>
    </div>
    <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">Simpan</button>
</form>
@endsection
