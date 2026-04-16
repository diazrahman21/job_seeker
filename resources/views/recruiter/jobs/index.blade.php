@extends('layouts.recruiter', ['title' => 'Lowongan Saya'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Lowongan Saya</h2>
            <p class="text-slate-500 mt-1">Kelola semua lowongan kerja Anda</p>
        </div>
        <a href="{{ route('recruiter.jobs.create') }}" class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors font-medium no-underline">
            <x-icon name="document-text" class="w-5 h-5" />
            Tambah Lowongan
        </a>
    </div>

    <!-- Filter & Search Card -->
    <x-card title="Filter & Pencarian">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-input 
                    name="search" 
                    label="Cari Lowongan"
                    placeholder="Judul atau deskripsi..." 
                    value="{{ request('search') }}" 
                />
                <x-input 
                    name="status" 
                    label="Status"
                    type="select"
                    value="{{ request('status') }}"
                >
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                    <option value="pending">Menunggu Persetujuan</option>
                    <option value="closed">Ditutup</option>
                </x-input>
                <div class="flex items-end gap-2">
                    <x-button type="submit" variant="primary" class="flex-1">
                        <span class="flex items-center gap-2 justify-center">
                            <x-icon name="magnifying-glass" class="w-5 h-5" />
                            Cari
                        </span>
                    </x-button>
                </div>
                <div>
                    <a href="{{ route('recruiter.jobs.index') }}" class="block px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium text-center no-underline text-sm">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </x-card>

    <!-- Jobs List -->
    @if($jobs->count() > 0)
    <div class="space-y-4">
        @foreach($jobs as $job)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $job->title }}</h3>
                            <x-status-badge :status="$job->status ?? 'active'" size="sm" />
                        </div>
                        
                        <p class="text-slate-600 text-sm mb-3">{{ Str::limit($job->description, 150) }}</p>
                        
                        <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                            @if($job->location)
                            <span class="flex items-center gap-1">
                                <x-icon name="magnifying-glass" class="w-4 h-4" />
                                {{ $job->location }}
                            </span>
                            @endif
                            
                            @if($job->job_type)
                            <span class="flex items-center gap-1">
                                <x-icon name="briefcase" class="w-4 h-4" />
                                {{ $job->job_type }}
                            </span>
                            @endif
                            
                            @if($job->salary_min && $job->salary_max)
                            <span class="flex items-center gap-1">
                                <x-icon name="chart-bar" class="w-4 h-4" />
                                Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}
                            </span>
                            @endif
                            
                            <span class="flex items-center gap-1">
                                <x-icon name="users" class="w-4 h-4" />
                                {{ $job->applications_count ?? 0 }} pelamar
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('recruiter.applicants.index', ['job_id' => $job->id]) }}" class="px-3 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium no-underline text-center">
                            Lihat Pelamar
                        </a>
                        <a href="{{ route('recruiter.jobs.edit', $job->id) }}" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium no-underline text-center">
                            Edit
                        </a>
                        <button type="button" onclick="if(confirm('Apakah Anda yakin ingin menghapus lowongan ini?')) document.getElementById('delete-form-{{ $job->id }}').submit();" class="px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm font-medium">
                            Hapus
                        </button>
                        <form id="delete-form-{{ $job->id }}" action="{{ route('recruiter.jobs.destroy', $job->id) ?? '#' }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
    @else
    <x-empty-state 
        title="Tidak Ada Lowongan"
        description="Mulai posting lowongan untuk menerima pelamar"
        icon="briefcase"
        buttonText="Buat Lowongan Baru"
        buttonUrl="{{ route('recruiter.jobs.create') }}"
    />
    @endif
</div>
@endsection
