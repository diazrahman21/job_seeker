<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Board' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="text-xl font-black tracking-tight">JobBoard</a>
            <nav class="flex items-center gap-3 text-sm">
                @auth('job_seeker')
                    <a href="{{ route('job-seeker.jobs') }}" class="rounded px-3 py-2 hover:bg-slate-100">Lowongan</a>
                    <a href="{{ route('job-seeker.dashboard') }}" class="rounded px-3 py-2 hover:bg-slate-100">Dashboard</a>
                    <a href="{{ route('job-seeker.profile') }}" class="rounded px-3 py-2 hover:bg-slate-100">Profile</a>
                @endauth
                @auth('recruiter')
                    <a href="{{ route('recruiter.jobs') }}" class="rounded px-3 py-2 hover:bg-slate-100">Lowongan Saya</a>
                    <a href="{{ route('recruiter.dashboard') }}" class="rounded px-3 py-2 hover:bg-slate-100">Dashboard</a>
                    <a href="{{ route('recruiter.profile') }}" class="rounded px-3 py-2 hover:bg-slate-100">Profil Perusahaan</a>
                @endauth
                @auth('admin')
                    <a href="{{ route('admin.dashboard') }}" class="rounded px-3 py-2 hover:bg-slate-100">Admin</a>
                @endauth
                @if(auth('job_seeker')->check() || auth('recruiter')->check() || auth('admin')->check())
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded bg-slate-900 px-3 py-2 text-white">Logout</button>
                    </form>
                @endif
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-6">
        @if(session('success'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
