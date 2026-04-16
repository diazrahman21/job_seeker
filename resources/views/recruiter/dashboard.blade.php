@extends('layouts.recruiter', ['title' => 'Dashboard Recruiter'])

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-slate-900">Dashboard Recruiter</h1>
            <p class="text-slate-600 mt-1">Kelola lowongan dan pelamar dengan mudah</p>
        </div>
        <a href="{{ route('recruiter.jobs.create') }}" class="flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 font-bold text-lg no-underline shadow-md hover:shadow-lg hover:-translate-y-0.5">
            <x-icon name="plus-circle" class="w-6 h-6" />
            Tambah Lowongan
        </a>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card 
            title="Total Lowongan"
            value="{{ $totalJobs ?? $totalPostings ?? 0 }}"
            icon="briefcase"
            trend="+2 bulan ini"
            trendType="positive"
        />
        
        <x-stat-card 
            title="Lowongan Aktif"
            value="{{ $activeJobs ?? 0 }}"
            icon="check-circle"
            trend="sedang aktif"
            trendType="positive"
        />
        
        <x-stat-card 
            title="Total Pelamar"
            value="{{ $totalApplicants ?? 0 }}"
            icon="users"
            trend="+12 minggu ini"
            trendType="positive"
        />
        
        <x-stat-card 
            title="Pelamar Hari Ini"
            value="{{ $todayApplicants ?? 0 }}"
            icon="inbox"
            trend="baru ditambah"
            trendType="positive"
        />
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <x-card title="Lowongan Terbaru">
                @if(isset($recentJobs) && $recentJobs->count() > 0)
                <div class="space-y-3">
                    @foreach($recentJobs as $job)
                    <a href="{{ route('recruiter.jobs.show', $job->id) ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-200 border border-gray-100 hover:border-blue-200 hover:shadow-sm">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $job->title }}</p>
                            <div class="flex items-center gap-4 text-sm text-gray-700 mt-1">
                                <span class="flex items-center gap-1">
                                    <x-icon name="magnifying-glass" class="w-4 h-4" />
                                    {{ $job->applications_count ?? 0 }} pelamar
                                </span>
                                <span>Dibuat {{ $job->created_at->diffForHumans() ?? 'recently' }}</span>
                            </div>
                        </div>
                        <x-status-badge :status="$job->status ?? 'active'" />
                    </a>
                    @endforeach
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
            </x-card>
        </div>

        <!-- Status Distribution -->
        <div>
            <x-card title="Status Pelamar">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-800">Applied</span>
                        <span class="font-bold text-gray-900">{{ $applicantsByStatus['applied'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $applicantsByStatus['applied'] ? (($applicantsByStatus['applied'] / ($totalApplicants ?: 1)) * 100) : 0 }}%"></div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-sm font-medium text-gray-800">Under Review</span>
                        <span class="font-bold text-gray-900">{{ $applicantsByStatus['review'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $applicantsByStatus['review'] ? (($applicantsByStatus['review'] / ($totalApplicants ?: 1)) * 100) : 0 }}%"></div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-sm font-medium text-gray-800">Interview</span>
                        <span class="font-bold text-gray-900">{{ $applicantsByStatus['interview'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $applicantsByStatus['interview'] ? (($applicantsByStatus['interview'] / ($totalApplicants ?: 1)) * 100) : 0 }}%"></div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-sm font-medium text-gray-800">Hired</span>
                        <span class="font-bold text-gray-900">{{ $applicantsByStatus['hired'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $applicantsByStatus['hired'] ? (($applicantsByStatus['hired'] / ($totalApplicants ?: 1)) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Pending Approvals -->
    @if(isset($pendingJobs) && $pendingJobs->count() > 0)
    <x-card title="Menunggu Persetujuan Admin" class="border-l-4 border-l-yellow-500">
        <div class="space-y-3">
            @foreach($pendingJobs as $job)
            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                <div>
                    <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                    <p class="text-sm text-slate-600 mt-1">Dikonfirmasi {{ $job->updated_at->diffForHumans() ?? 'recently' }}</p>
                </div>
                <x-status-badge status="pending" />
            </div>
            @endforeach
        </div>
    </x-card>
    @endif
</div>
@endsection
