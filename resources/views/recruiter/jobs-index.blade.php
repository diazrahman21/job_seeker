@extends('layouts.app')
@section('content')
<div class="mb-4 flex items-center justify-between"><h1 class="text-2xl font-bold">Lowongan Saya</h1><a href="{{ route('recruiter.jobs.create') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-white">Tambah</a></div>
<div class="overflow-x-auto rounded-lg border bg-white">
<table class="min-w-full text-sm">
<thead class="bg-slate-100"><tr><th class="p-3 text-left">Judul</th><th class="p-3">Status</th><th class="p-3">Aksi</th></tr></thead>
<tbody>
@foreach($jobs as $job)
<tr class="border-t"><td class="p-3">{{ $job->title }}</td><td class="p-3 text-center">{{ $job->status }}</td><td class="p-3 text-right">
<a class="mr-2 text-indigo-600" href="{{ route('recruiter.jobs.edit', $job) }}">Edit</a>
<a class="mr-2 text-teal-600" href="{{ route('recruiter.jobs.applicants', $job) }}">Pelamar</a>
<form method="post" action="{{ route('recruiter.jobs.delete', $job) }}" class="inline">@csrf @method('delete') <button class="text-rose-600">Hapus</button></form>
</td></tr>
@endforeach
</tbody>
</table>
</div>
@endsection
