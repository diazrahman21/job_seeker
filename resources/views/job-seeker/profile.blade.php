@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Profil Pelamar</h1>
<div class="grid gap-4 lg:grid-cols-2">
<div class="rounded-xl border bg-white p-4">
    <form method="post" action="{{ route('job-seeker.profile.update') }}" enctype="multipart/form-data" class="space-y-2">
        @csrf
        <input name="name" value="{{ $user->name }}" class="w-full rounded-lg border-slate-300" required>
        <input name="title" value="{{ $user->title }}" placeholder="Title" class="w-full rounded-lg border-slate-300">
        <input name="location" value="{{ $user->location }}" placeholder="Lokasi" class="w-full rounded-lg border-slate-300">
        <textarea name="bio" placeholder="Bio" class="w-full rounded-lg border-slate-300">{{ $user->bio }}</textarea>
        <input name="skills" value="{{ implode(', ', $user->skills ?? []) }}" placeholder="skills, dipisah koma" class="w-full rounded-lg border-slate-300">
        <input name="photo" type="file" class="w-full rounded-lg border-slate-300">
        <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">Simpan Profil</button>
    </form>
</div>
<div class="rounded-xl border bg-white p-4">
    <h2 class="font-bold">CV (Spatie Media Library)</h2>
    <form method="post" action="{{ route('job-seeker.cv.upload') }}" enctype="multipart/form-data" class="mt-2 flex gap-2">
        @csrf
        <input type="file" name="cv_file" class="w-full rounded-lg border-slate-300" required>
        <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">Upload</button>
    </form>
    <ul class="mt-3 space-y-2 text-sm">
        @foreach($cvs as $cv)
            <li class="flex items-center justify-between rounded border p-2">
                <a href="{{ $cv->getUrl() }}" target="_blank">{{ $cv->name }}</a>
                <form method="post" action="{{ route('job-seeker.cv.delete', $cv->id) }}">@csrf @method('delete') <button class="text-rose-600">Hapus</button></form>
            </li>
        @endforeach
    </ul>
</div>
</div>
@endsection
