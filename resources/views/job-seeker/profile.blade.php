@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Profil Pelamar</h1>
<div class="grid gap-4 lg:grid-cols-2">
<div class="rounded-xl border bg-white p-4">
    <form method="post" action="{{ route('job-seeker.profile.update') }}" enctype="multipart/form-data" class="space-y-2">
        @csrf
        <input name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-slate-300" required>
        <input name="title" value="{{ old('title', $profile->title) }}" placeholder="Title" class="w-full rounded-lg border-slate-300">
        <input name="location" value="{{ old('location', $profile->location) }}" placeholder="Lokasi" class="w-full rounded-lg border-slate-300">
        <textarea name="bio" placeholder="Bio" class="w-full rounded-lg border-slate-300">{{ old('bio', $profile->bio) }}</textarea>
        <input name="skills" value="{{ old('skills', implode(', ', $skills ?? [])) }}" placeholder="skills, dipisah koma" class="w-full rounded-lg border-slate-300">
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

<div class="mt-4 grid gap-4 lg:grid-cols-2">
<div class="rounded-xl border bg-white p-4">
    <h2 class="font-bold">Pengalaman Kerja</h2>
    <form method="post" action="{{ route('job-seeker.experience.add') }}" class="mt-2 space-y-2">
        @csrf
        <input name="company_name" placeholder="Nama Perusahaan" class="w-full rounded-lg border-slate-300" required>
        <input name="job_title" placeholder="Posisi" class="w-full rounded-lg border-slate-300" required>
        <div class="grid gap-2 md:grid-cols-2">
            <input type="date" name="start_date" class="w-full rounded-lg border-slate-300" required>
            <input type="date" name="end_date" class="w-full rounded-lg border-slate-300" placeholder="Selesai (opsional)">
        </div>
        <textarea name="description" placeholder="Deskripsi pekerjaan" class="w-full rounded-lg border-slate-300"></textarea>
        <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">Tambah Pengalaman</button>
    </form>

    <ul class="mt-3 space-y-2 text-sm">
        @foreach($experiences as $experience)
            <li class="rounded border p-2">
                <p class="font-semibold">{{ $experience->job_title }} - {{ $experience->company_name }}</p>
                <p class="text-slate-500">{{ optional($experience->start_date)->format('Y-m-d') }} s/d {{ optional($experience->end_date)->format('Y-m-d') ?? 'Sekarang' }}</p>
                @if($experience->description)
                    <p class="mt-1 text-slate-700">{{ $experience->description }}</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>

<div class="rounded-xl border bg-white p-4">
    <h2 class="font-bold">Riwayat Pendidikan</h2>
    <form method="post" action="{{ route('job-seeker.education.add') }}" class="mt-2 space-y-2">
        @csrf
        <input name="school_name" placeholder="Nama Institusi" class="w-full rounded-lg border-slate-300" required>
        <input name="degree" placeholder="Jenjang (S1/S2/Diploma)" class="w-full rounded-lg border-slate-300" required>
        <input name="field_of_study" placeholder="Jurusan" class="w-full rounded-lg border-slate-300">
        <div class="grid gap-2 md:grid-cols-2">
            <input type="number" name="start_year" min="1950" max="2100" placeholder="Tahun Mulai" class="w-full rounded-lg border-slate-300">
            <input type="number" name="end_year" min="1950" max="2100" placeholder="Tahun Selesai" class="w-full rounded-lg border-slate-300">
        </div>
        <textarea name="description" placeholder="Deskripsi" class="w-full rounded-lg border-slate-300"></textarea>
        <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">Tambah Pendidikan</button>
    </form>

    <ul class="mt-3 space-y-2 text-sm">
        @foreach($educations as $education)
            <li class="rounded border p-2">
                <p class="font-semibold">{{ $education->school_name }} - {{ $education->degree }}</p>
                <p class="text-slate-500">{{ $education->start_year ?? '-' }} - {{ $education->end_year ?? 'Sekarang' }}</p>
                @if($education->field_of_study)
                    <p class="text-slate-700">Jurusan: {{ $education->field_of_study }}</p>
                @endif
                @if($education->description)
                    <p class="mt-1 text-slate-700">{{ $education->description }}</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>
</div>
@endsection
