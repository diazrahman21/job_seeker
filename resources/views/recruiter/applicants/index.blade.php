@extends('layouts.recruiter', ['title' => 'Pelamar'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        @if(request('job_id'))
        <a href="{{ route('recruiter.jobs.index') }}" class="text-blue-600 hover:text-blue-700 no-underline text-sm font-medium flex items-center gap-1 mb-4">
            <x-icon name="arrow-left-on-rectangle" class="w-4 h-4 rotate-180" />
            Kembali
        </a>
        @endif
        <h2 class="text-2xl font-bold text-slate-900">Daftar Pelamar</h2>
        <p class="text-slate-500 mt-1">Kelola pelamar untuk semua lowongan</p>
    </div>

    <!-- Filter & Search Card -->
    <x-card title="Filter & Pencarian">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-input 
                    name="search" 
                    label="Cari Pelamar"
                    placeholder="Nama atau email..." 
                    value="{{ request('search') }}" 
                />
                
                <x-input 
                    name="status" 
                    label="Status"
                    type="select"
                    value="{{ request('status') }}"
                >
                    <option value="">Semua Status</option>
                    <option value="applied">Applied</option>
                    <option value="review">Under Review</option>
                    <option value="interview">Interview</option>
                    <option value="hired">Hired</option>
                    <option value="rejected">Rejected</option>
                </x-input>

                @if(request('job_id'))
                <input type="hidden" name="job_id" value="{{ request('job_id') }}">
                @else
                <x-input 
                    name="job_id" 
                    label="Lowongan"
                    type="select"
                    value="{{ request('job_id') }}"
                >
                    <option value="">Semua Lowongan</option>
                    @foreach($jobs as $job)
                    <option value="{{ $job->id }}">{{ $job->title }}</option>
                    @endforeach
                </x-input>
                @endif

                <div class="flex items-end gap-2">
                    <x-button type="submit" variant="primary" class="flex-1">
                        <span class="flex items-center gap-2 justify-center">
                            <x-icon name="magnifying-glass" class="w-5 h-5" />
                            Cari
                        </span>
                    </x-button>
                </div>
            </div>
        </form>
    </x-card>

    <!-- Applicants List -->
    @if($applicants->count() > 0)
    <div class="space-y-4">
        @foreach($applicants as $applicant)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($applicant->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-lg font-semibold text-slate-900">{{ $applicant->user->name }}</p>
                                <p class="text-sm text-slate-500">untuk {{ $applicant->job->title }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 text-sm text-slate-600">
                            <p class="flex items-center gap-2">
                                <x-icon name="document-text" class="w-4 h-4" />
                                {{ $applicant->user->email }}
                            </p>
                            @if($applicant->user->phone ?? null)
                            <p class="flex items-center gap-2">
                                <x-icon name="magnifying-glass" class="w-4 h-4" />
                                {{ $applicant->user->phone }}
                            </p>
                            @endif
                            <p class="text-xs text-slate-500">
                                Melamar {{ $applicant->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 min-w-max">
                        <x-status-badge :status="$applicant->status ?? 'applied'" />
                        
                        <a href="{{ route('recruiter.applicants.show', $applicant->id) }}" class="px-3 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium no-underline text-center">
                            Lihat Detail
                        </a>

                        <button 
                            type="button"
                            onclick="openStatusModal({{ $applicant->id }}, '{{ $applicant->status ?? 'applied' }}')"
                            class="px-3 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors text-sm font-medium"
                        >
                            Update Status
                        </button>

                        @if($applicant->cv_path)
                        <a href="{{ Storage::url($applicant->cv_path) }}" download class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium no-underline text-center">
                            Download CV
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $applicants->links() }}
    </div>
    @else
    <x-empty-state 
        title="Tidak Ada Pelamar"
        description="Belum ada pelamar untuk lowongan Anda"
        icon="users"
    />
    @endif
</div>

<!-- Status Update Modal -->
<x-modal id="statusModal" title="Update Status Pelamar" size="md">
    <form id="statusForm" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <input type="hidden" id="applicantId" name="applicant_id">

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Status Baru</label>
            <select id="newStatus" name="status" class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5" required>
                <option value="applied">Applied</option>
                <option value="review">Under Review</option>
                <option value="interview">Interview</option>
                <option value="hired">Hired</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Catatan (Opsional)</label>
            <textarea name="notes" rows="3" placeholder="Tambahkan catatan tentang keputusan Anda..." class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5"></textarea>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <x-button type="submit" variant="primary">
                Simpan Perubahan
            </x-button>
            <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium">
                Batal
            </button>
        </div>
    </form>
</x-modal>

<script>
    function openStatusModal(applicantId, currentStatus) {
        document.getElementById('applicantId').value = applicantId;
        document.getElementById('newStatus').value = currentStatus;
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusForm').action = '/recruiter/applicants/' + applicantId + '/status';
    }
</script>
@endsection
