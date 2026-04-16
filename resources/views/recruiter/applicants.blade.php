@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Pelamar - {{ $job->title }}</h1>
<div class="space-y-3">
@foreach($applications as $app)
    <div class="rounded-xl border bg-white p-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
                <p class="font-semibold">{{ $app->user->name }}</p>
                <p class="text-sm text-slate-500">{{ $app->user->email }}</p>
            </div>
            <a href="{{ route('recruiter.applications.cv', $app) }}" class="rounded border px-3 py-1 text-sm">Download CV</a>
        </div>
        <form method="post" action="{{ route('recruiter.applications.status', $app) }}" class="mt-3 grid gap-2 md:grid-cols-3">
            @csrf @method('put')
            <select name="status" class="rounded-lg border-slate-300">
                @foreach(['applied','review','interview','rejected','hired'] as $s)
                    <option value="{{ $s }}" @selected($app->status === $s)>{{ $s }}</option>
                @endforeach
            </select>
            <input name="status_note" value="{{ $app->status_note }}" placeholder="Catatan" class="rounded-lg border-slate-300 md:col-span-2">
            <button class="rounded-lg bg-slate-900 px-3 py-2 text-white md:col-span-3">Update Status</button>
        </form>
    </div>
@endforeach
</div>
@endsection
