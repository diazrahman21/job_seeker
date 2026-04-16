@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Bookmark Lowongan</h1>
<div class="grid gap-3">
    @foreach($jobs as $job)
        <a href="{{ route('job-seeker.jobs.detail', $job) }}" class="rounded-lg border bg-white p-4">
            <p class="font-semibold">{{ $job->title }}</p>
            <p class="text-sm text-slate-500">{{ $job->company->name }} - {{ $job->location }}</p>
        </a>
    @endforeach
</div>
@endsection
