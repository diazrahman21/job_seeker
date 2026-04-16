@extends('layouts.job-seeker', ['title' => 'Dashboard Pencari Kerja'])

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-slate-900">Dashboard Pencari Kerja</h1>
            <p class="text-slate-600 mt-1">Kelola profil dan lamaran pekerjaan Anda</p>
        </div>
        <a href="{{ route('job-seeker.jobs') }}" class="flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 font-bold text-lg no-underline shadow-md hover:shadow-lg hover:-translate-y-0.5">
            <x-icon name="magnifying-glass" class="w-6 h-6" />
            Cari Lowongan
        </a>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <x-stat-card 
            title="Total Lamaran"
            value="{{ count($applications ?? []) }}"
            icon="inbox"
            trend="Seluruh waktu"
            trendType="positive"
        />
        
        <x-stat-card 
            title="Applied"
            value="{{ $statusCounts['applied'] ?? 0 }}"
            icon="envelope"
        />
        
        <x-stat-card 
            title="Under Review"
            value="{{ $statusCounts['review'] ?? 0 }}"
            icon="clock"
        />
        
        <x-stat-card 
            title="Interview"
            value="{{ $statusCounts['interview'] ?? 0 }}"
            icon="users"
        />
        
        <x-stat-card 
            title="Hired"
            value="{{ $statusCounts['hired'] ?? 0 }}"
            icon="check-circle"
        />
    </div>

    <!-- Recent Applications -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <x-card title="Lamaran Terbaru">
                @if(isset($applications) && count($applications) > 0)
                <div class="space-y-3">
                    @foreach($applications->take(5) as $app)
                    <a href="#" class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-200 border border-gray-100 hover:border-blue-200 hover:shadow-sm">
                        <div class="flex-1">
                            <p class="font-semibold text-slate-900">{{ $app->job->title }}</p>
                            <div class="flex items-center gap-4 text-sm text-slate-600 mt-1">
                                <span class="flex items-center gap-1">
                                    <x-icon name="building-office-2" class="w-4 h-4" />
                                    {{ $app->job->company->name }}
                                </span>
                                <span>{{ $app->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <x-badge :status="$app->status" />
                    </a>
                    @endforeach
                </div>
                @else
                <x-empty-state 
                    title="Belum Ada Lamaran"
                    description="Mulai cari lowongan dan kirimkan lamaran"
                    icon="inbox"
                    buttonText="Jelajahi Lowongan"
                    buttonUrl="{{ route('job-seeker.jobs') }}"
                />
                @endif
            </x-card>
        </div>

        <!-- Quick Stats -->
        <div>
            <x-card title="Status Lamaran">
                <div class="space-y-4">
                    @php
                        $totalApps = count($applications ?? []);
                        $statuses = [
                            'applied' => 'Applied',
                            'review' => 'Under Review',
                            'interview' => 'Interview',
                            'rejected' => 'Rejected',
                            'hired' => 'Hired',
                        ];
                    @endphp
                    @foreach($statuses as $key => $label)
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
                                <span class="font-bold text-slate-900">{{ $statusCounts[$key] ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $percentage = $totalApps > 0 ? (($statusCounts[$key] ?? 0) / $totalApps) * 100 : 0;
                                    $colors = [
                                        'applied' => 'bg-blue-500',
                                        'review' => 'bg-yellow-500',
                                        'interview' => 'bg-purple-500',
                                        'rejected' => 'bg-red-500',
                                        'hired' => 'bg-green-500',
                                    ];
                                    $bgColor = $colors[$key] ?? 'bg-gray-500';
                                @endphp
                                <div class="{{ $bgColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </div>

    <!-- Profile Completion Status -->
    @if(isset($profileCompletion))
    <x-card title="Kelengkapan Profil">
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-slate-700 font-medium">Progres Profil</span>
                <span class="font-bold text-slate-900">{{ $profileCompletion }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $profileCompletion }}%"></div>
            </div>
            @if($profileCompletion < 100)
            <p class="text-sm text-slate-600">Lengkapi profil Anda untuk meningkatkan peluang mendapat pekerjaan</p>
            <a href="{{ route('job-seeker.profile') }}" class="inline-block bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors px-4 py-2 rounded-lg font-medium no-underline">
                Lengkapi Profil
            </a>
            @endif
        </div>
    </x-card>
    @endif
</div>
@endsection
