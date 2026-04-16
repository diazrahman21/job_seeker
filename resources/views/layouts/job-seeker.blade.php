<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Seeker Dashboard' }} - Job Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 text-slate-900">
    <div class="flex min-h-screen flex-col">
        <!-- Sidebar + Main Layout -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="fixed left-0 top-0 h-screen w-64 overflow-y-auto border-r border-gray-200 bg-white shadow-sm md:relative md:w-auto">
                <!-- Sidebar Header -->
                <div class="border-b border-gray-200 px-6 py-6">
                    <a href="{{ route('job-seeker.dashboard') }}" class="flex items-center gap-2 text-2xl font-bold text-blue-600 no-underline hover:text-blue-700 transition-colors">
                        <x-icon name="users" class="w-8 h-8" />
                        <span>MyJob</span>
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2 p-4">
                    <a href="{{ route('job-seeker.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('job-seeker.dashboard') ? 'bg-blue-100 text-blue-600' : 'text-slate-600 hover:bg-gray-100' }}">
                        <x-icon name="chart-bar" class="w-5 h-5" />
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('job-seeker.jobs') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('job-seeker.jobs') ? 'bg-blue-100 text-blue-600' : 'text-slate-600 hover:bg-gray-100' }}">
                        <x-icon name="briefcase" class="w-5 h-5" />
                        <span>Cari Lowongan</span>
                    </a>
                    <a href="{{ route('job-seeker.profile') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('job-seeker.profile') ? 'bg-blue-100 text-blue-600' : 'text-slate-600 hover:bg-gray-100' }}">
                        <x-icon name="users" class="w-5 h-5" />
                        <span>Profil Saya</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="border-t border-gray-200 p-4">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <x-button variant="danger" size="md" class="w-full">
                            <span class="flex items-center gap-2 justify-center">
                                <x-icon name="arrow-left-on-rectangle" class="w-5 h-5" />
                                Keluar
                            </span>
                        </x-button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 md:ml-0">
                <!-- Top Header -->
                <header class="border-b border-gray-200 bg-white shadow-sm sticky top-0 z-30">
                    <div class="flex items-center justify-between px-6 md:px-8 py-4 md:py-6">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">{{ $title ?? 'Dashboard' }}</h1>
                            <p class="text-sm text-slate-500 mt-1">Kelola profil dan lamaran Anda</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-medium text-slate-900">{{ auth('job_seeker')->user()->name ?? 'Pengguna' }}</p>
                                <p class="text-xs text-slate-500">Pencari Kerja</p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <section class="p-4 md:p-8">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="mb-6 animate-slide-in rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-green-700 shadow-sm flex items-center gap-3 transition-all duration-200">
                            <x-icon name="check-circle" class="w-6 h-6 flex-shrink-0" />
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 animate-slide-in rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-700 shadow-sm flex items-center gap-3 transition-all duration-200">
                            <x-icon name="exclamation-triangle" class="w-6 h-6 flex-shrink-0" />
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 animate-slide-in rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-700 shadow-sm transition-all duration-200">
                            <div class="flex items-center gap-3 mb-3">
                                <x-icon name="x-circle" class="w-6 h-6 flex-shrink-0" />
                                <p class="font-semibold">Ada kesalahan:</p>
                            </div>
                            <ul class="ml-9 list-inside list-disc space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Main Content Yield -->
                    @yield('content')
                </section>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
