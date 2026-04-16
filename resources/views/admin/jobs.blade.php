@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Moderasi Lowongan</h1>
<div class="space-y-3">
@foreach($jobs as $job)
    <div class="rounded-lg border bg-white p-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
                <p class="font-semibold">{{ $job->title }}</p>
                <p class="text-sm text-slate-500">{{ $job->company->name }} - {{ $job->location }}</p>
            </div>
            <form method="post" action="{{ route('admin.jobs.status', $job) }}" class="flex gap-2">@csrf @method('put')
                <select name="status" class="rounded border-slate-300 text-sm">
                    @foreach(['pending','approved','rejected'] as $s)
                        <option value="{{ $s }}" @selected($job->status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
                <button class="rounded bg-slate-900 px-3 py-1 text-white text-sm">Update</button>
            </form>
        </div>
    </div>
@endforeach
</div>
@endsection
