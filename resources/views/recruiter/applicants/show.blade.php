@extends('layouts.recruiter', ['title' => 'Detail Pelamar'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-start justify-between">
        <div>
            <a href="{{ route('recruiter.applicants.index') }}" class="text-blue-600 hover:text-blue-700 no-underline text-sm font-medium flex items-center gap-1 mb-4">
                <x-icon name="arrow-left-on-rectangle" class="w-4 h-4 rotate-180" />
                Kembali ke Daftar Pelamar
            </a>
            <h2 class="text-2xl font-bold text-slate-900">{{ $applicant->user->name }}</h2>
            <p class="text-slate-500 mt-1">Melamar sebagai {{ $applicant->job->title }}</p>
        </div>
        <div class="flex flex-col gap-2">
            <x-status-badge :status="$applicant->status ?? 'applied'" size="lg" />
            <button 
                type="button"
                onclick="openStatusModal({{ $applicant->id }}, '{{ $applicant->status ?? 'applied' }}')"
                class="px-4 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors font-medium text-sm no-underline text-center"
            >
                Ubah Status
            </button>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Sidebar -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <x-card>
                <div class="text-center mb-4">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-3xl mx-auto mb-4">
                        {{ strtoupper(substr($applicant->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">{{ $applicant->user->name }}</h3>
                </div>

                <div class="space-y-3 border-t border-gray-200 pt-4">
                    <a href="mailto:{{ $applicant->user->email }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 no-underline">
                        <x-icon name="document-text" class="w-5 h-5" />
                        <span class="text-sm break-all">{{ $applicant->user->email }}</span>
                    </a>

                    @if($applicant->user->phone ?? null)
                    <a href="tel:{{ $applicant->user->phone }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 no-underline">
                        <x-icon name="magnifying-glass" class="w-5 h-5" />
                        <span class="text-sm">{{ $applicant->user->phone }}</span>
                    </a>
                    @endif

                    <p class="text-sm text-slate-500 flex items-center gap-2">
                        <x-icon name="clock" class="w-5 h-5" />
                        Melamar {{ $applicant->created_at->diffForHumans() }}
                    </p>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('recruiter.applicants.cv', $applicant->id) }}" class="flex items-center gap-2 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-center no-underline justify-center">
                        <x-icon name="document-text" class="w-5 h-5" />
                        Download CV
                    </a>
                </div>
            </x-card>
        </div>

        <!-- Right Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Cover Letter -->
            @if($applicant->cover_letter)
            <x-card title="Surat Lamaran">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                    {{ $applicant->cover_letter }}
                </p>
            </x-card>
            @endif

            <!-- Status Notes -->
            @if($applicant->status_note)
            <x-card title="Catatan Status">
                <p class="text-slate-700">
                    {{ $applicant->status_note }}
                </p>
            </x-card>
            @endif
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<x-modal id="statusModal" title="Update Status Pelamar" size="md">
    <form id="statusForm" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

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
            <textarea name="status_note" rows="3" placeholder="Tambahkan catatan tentang keputusan Anda..." class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5"></textarea>
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
        document.getElementById('newStatus').value = currentStatus;
        document.getElementById('statusForm').action = '/recruiter/applicants/' + applicantId + '/status';
        document.getElementById('statusModal').classList.remove('hidden');
    }
</script>
@endsection
