<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Board' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 text-slate-900">
    <!-- Topbar Navigation -->
    <header class="sticky top-0 z-40 border-b border-gray-200 bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-bold text-blue-600 no-underline hover:text-blue-700 transition-colors">
                <x-icon name="briefcase" class="w-8 h-8" />
                <span>JobBoard</span>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                @auth('job_seeker')
                    <a href="{{ route('job-seeker.jobs') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Lowongan</a>
                    <a href="{{ route('job-seeker.dashboard') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Dashboard</a>
                    <a href="{{ route('job-seeker.profile') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Profile</a>
                @endauth
                @auth('recruiter')
                    <a href="{{ route('recruiter.jobs.index') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Lowongan Saya</a>
                    <a href="{{ route('recruiter.dashboard') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Dashboard</a>
                    <a href="{{ route('recruiter.profile.edit') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Profil</a>
                @endauth
                @auth('admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-blue-600 no-underline transition-colors duration-200">Admin</a>
                @endauth
            </nav>

            <!-- Auth Section -->
            <div class="flex items-center gap-4">
                @if(auth('job_seeker')->check() || auth('recruiter')->check() || auth('admin')->check())
                    <span class="text-sm text-slate-600 hidden md:inline">{{ auth()->user()->name ?? 'User' }}</span>
                    <form method="post" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <x-button variant="secondary" size="sm">
                            Keluar
                        </x-button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium no-underline hover:text-blue-700 transition-colors">Login</a>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container-max px-4 py-8">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 animate-slide-in rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-green-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <x-icon name="check-circle" class="w-6 h-6" />
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 animate-slide-in rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <x-icon name="exclamation-triangle" class="w-6 h-6" />
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 animate-slide-in rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <x-icon name="x-circle" class="w-6 h-6" />
                    <div>
                        <p class="font-semibold">Ada kesalahan:</p>
                        <ul class="mt-2 list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
