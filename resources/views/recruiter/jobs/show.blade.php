@extends('layouts.recruiter', ['title' => 'Detail Lowongan'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-start justify-between">
        <div>
            <a href="{{ route('recruiter.jobs.index') }}" class="text-blue-600 hover:text-blue-700 no-underline text-sm font-medium flex items-center gap-1 mb-4">
                <x-icon name="arrow-left-on-rectangle" class="w-4 h-4 rotate-180" />
                Kembali ke Lowongan
            </a>
            <h2 class="text-2xl font-bold text-slate-900">{{ $job->title }}</h2>
            <p class="text-slate-500 mt-1">{{ $job->location }} • {{ $job->employment_type }}</p>
        </div>
        <div class="flex flex-col gap-2">
            <x-status-badge :status="$job->status ?? 'pending'" size="lg" />
            <div class="flex gap-2">
                <a href="{{ route('recruiter.jobs.edit', $job->id) }}" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors font-medium text-sm no-underline text-center">
                    Edit
                </a>
                <button 
                    type="button"
                    onclick="if(confirm('Apakah Anda yakin ingin menghapus lowongan ini?')) document.getElementById('delete-form-{{ $job->id }}').submit();"
                    class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors font-medium text-sm"
                >
                    Hapus
                </button>
                <form id="delete-form-{{ $job->id }}" action="{{ route('recruiter.jobs.destroy', $job->id) }}" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    <!-- Job Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Sidebar - Job Info -->
        <div class="space-y-6">
            <!-- Quick Info Card -->
            <x-card>
                <div class="space-y-4">
                    <div class="pb-4 border-b border-gray-200">
                        <p class="text-sm text-slate-600 mb-1">Tipe Pekerjaan</p>
                        <p class="font-semibold text-slate-900">{{ $job->employment_type }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <p class="text-sm text-slate-600 mb-1">Lokasi</p>
                        <p class="font-semibold text-slate-900">{{ $job->location }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <p class="text-sm text-slate-600 mb-1">Gaji</p>
                        <p class="font-semibold text-slate-900">
                            @if($job->salary_min && $job->salary_max)
                                Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp {{ number_format($job->salary_max, 0, ',', '.') }}
                            @elseif($job->salary_min)
                                Rp {{ number_format($job->salary_min, 0, ',', '.') }}+
                            @else
                                Tidak ditentukan
                            @endif
                        </p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <p class="text-sm text-slate-600 mb-1">Deadline</p>
                        <p class="font-semibold text-slate-900">
                            {{ $job->deadline_at->format('d M Y') }}
                            @if($job->deadline_at->isPast())
                                <span class="ml-2 inline-block px-2 py-1 bg-red-100 text-red-600 text-xs rounded-lg">Expired</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-600 mb-1">Status</p>
                        <p class="font-semibold text-slate-900 capitalize">{{ $job->status }}</p>
                    </div>
                </div>
            </x-card>

            <!-- Statistics -->
            <x-card>
                <div class="space-y-4">
                    <div class="text-center pb-4 border-b border-gray-200">
                        <p class="text-3xl font-bold text-blue-600">{{ $job->applications_count ?? 0 }}</p>
                        <p class="text-sm text-slate-600 mt-1">Total Pelamar</p>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-slate-600">Dibuat</p>
                        <p class="font-semibold text-slate-900">{{ $job->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Right Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <x-card title="Deskripsi Lowongan">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                    {{ $job->description }}
                </p>
            </x-card>

            <!-- Requirements -->
            <x-card title="Persyaratan">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                    {{ $job->requirements }}
                </p>
            </x-card>

            <!-- Applicants -->
            <x-card title="Pelamar ({{ $job->applications->count() }})">
                @if($job->applications->count() > 0)
                    <div class="space-y-3">
                        @foreach($job->applications as $application)
                        <div class="flex items-start justify-between p-3 rounded-lg bg-gray-50 border border-gray-100 hover:bg-gray-100 transition-colors">
                            <div class="flex-1">
                                <a href="{{ route('recruiter.applicants.show', $application->id) }}" class="text-base font-semibold text-blue-600 hover:text-blue-700 no-underline">
                                    {{ $application->user->name }}
                                </a>
                                <p class="text-sm text-slate-600">{{ $application->user->email }}</p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Melamar {{ $application->created_at->diffForHumans() }}
                                </p>
                            </div>
                            
                            <div class="flex items-center gap-2 ml-4">
                                <x-status-badge :status="$application->status ?? 'applied'" size="sm" />
                                <a href="{{ route('recruiter.applicants.show', $application->id) }}" class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium no-underline">
                                    Lihat
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                <div class="text-center py-8">
                    <x-icon name="users" class="w-12 h-12 text-gray-300 mx-auto mb-3" />
                    <p class="text-slate-600">Belum ada pelamar untuk lowongan ini</p>
                </div>
                @endif
            </x-card>
        </div>
    </div>
</div>
@endsection
