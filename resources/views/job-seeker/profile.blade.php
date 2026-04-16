@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Profil Pelamar</h1>

<div class="space-y-4">
<div class="rounded-xl border bg-white p-6">
    <h2 class="mb-4 text-lg font-semibold">Informasi Dasar</h2>
    <form method="post" action="{{ route('job-seeker.profile.update') }}" enctype="multipart/form-data" class="space-y-3" id="profile-form">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama <span class="text-rose-600">*</span></label>
            <input name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            @error('name')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
        </div>
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Title/Posisi <span class="text-rose-600">*</span></label>
                <input name="title" value="{{ old('title', $profile->title) }}" placeholder="Contoh: Web Developer" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                @error('title')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Lokasi <span class="text-rose-600">*</span></label>
                <input name="location" value="{{ old('location', $profile->location) }}" placeholder="Kota" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                @error('location')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Bio <span class="text-rose-600">*</span></label>
            <textarea name="bio" placeholder="Ceritakan tentang dirimu (minimal 10 karakter)..." class="w-full rounded-lg border border-slate-300 px-3 py-2 h-24" required minlength="10">{{ old('bio', $profile->bio) }}</textarea>
            @error('bio')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Skill <span class="text-rose-600">*</span> (Minimal 1, Maksimal 5)</label>
            @php
                $oldSkills = old('skills');
                $activeSkillIds = is_array($oldSkills) ? array_map('intval', $oldSkills) : ($selectedSkillIds ?? []);
            @endphp
            
            <div class="mb-3 flex flex-wrap gap-2" id="selected-skills-container">
                @foreach($skillOptions as $option)
                    @if(in_array($option->id, $activeSkillIds, true))
                        <button type="button" class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700 hover:bg-blue-200 skill-chip" data-skill-id="{{ $option->id }}">
                            {{ $option->name }}
                            <span class="font-bold">×</span>
                        </button>
                        <input type="hidden" name="skills[]" value="{{ $option->id }}" class="skill-input">
                    @endif
                @endforeach
            </div>

            <select id="skill-dropdown" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                <option value="">-- Pilih Skill --</option>
                @foreach($skillOptions as $option)
                    @if(!in_array($option->id, $activeSkillIds, true))
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endif
                @endforeach
            </select>
            <p class="text-xs text-slate-500 mt-1">Klik skill di dropdown untuk menambahkan. Klik pada skill yang sudah dipilih untuk menghapusnya.</p>
            @error('skills')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto Profil</label>
            <input name="photo" type="file" accept="image/*" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <button type="submit" class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Simpan Profil</button>
    </form>
</div>

<div class="rounded-xl border bg-white p-6">
    <h2 class="mb-4 text-lg font-semibold">CV / Resume</h2>
    <form method="post" action="{{ route('job-seeker.cv.upload') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div class="flex gap-2">
            <input type="file" name="cv_file" accept="application/pdf" class="flex-1 rounded-lg border border-slate-300 px-3 py-2" required>
            <button class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Upload</button>
        </div>
        @error('cv_file')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
    </form>
    @if($cvs->count())
        <div class="mt-4 space-y-2">
            <p class="text-sm font-medium text-slate-700">CV Tersimpan:</p>
            <ul class="space-y-2">
                @foreach($cvs as $cv)
                    <li class="flex items-center justify-between rounded-lg border border-slate-200 p-3">
                        <a href="{{ $cv->getUrl() }}" target="_blank" class="text-sm text-blue-600 hover:underline">{{ $cv->name }}</a>
                        <form method="post" action="{{ route('job-seeker.cv.delete', $cv->id) }}" class="inline">
                            @csrf @method('delete')
                            <button type="submit" class="text-sm text-rose-600 hover:text-rose-700">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="rounded-xl border bg-white p-6">
    <h2 class="mb-4 text-lg font-semibold">Pengalaman Kerja</h2>
    <form method="post" action="{{ route('job-seeker.experience.add') }}" class="mb-6 space-y-3 pb-6 border-b">
        @csrf
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Perusahaan</label>
                <input name="company_name" placeholder="PT Contoh Indonesia" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Posisi</label>
                <input name="job_title" placeholder="Senior Developer" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            </div>
        </div>
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Selesai (Opsional)</label>
                <input type="date" name="end_date" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Pekerjaan</label>
            <textarea name="description" placeholder="Jelaskan peran dan tanggung jawab Anda..." class="w-full rounded-lg border border-slate-300 px-3 py-2 h-20"></textarea>
        </div>
        <button type="submit" class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Tambah Pengalaman</button>
    </form>

    @if($experiences->count())
        <div class="space-y-3">
            <p class="text-sm font-medium text-slate-700">Riwayat Pengalaman:</p>
            @foreach($experiences as $experience)
                <div class="rounded-lg border border-slate-200 p-3">
                    <p class="font-semibold text-slate-900">{{ $experience->job_title }}</p>
                    <p class="text-sm text-slate-600">{{ $experience->company_name }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ optional($experience->start_date)->format('d M Y') }} - {{ optional($experience->end_date)?->format('d M Y') ?? 'Sekarang' }}</p>
                    @if($experience->description)
                        <p class="text-sm text-slate-700 mt-2">{{ $experience->description }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="rounded-xl border bg-white p-6">
    <h2 class="mb-4 text-lg font-semibold">Riwayat Pendidikan</h2>
    <form method="post" action="{{ route('job-seeker.education.add') }}" class="mb-6 space-y-3 pb-6 border-b">
        @csrf
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Institusi</label>
                <input name="school_name" placeholder="Universitas / Sekolah" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenjang</label>
                <input name="degree" placeholder="S1 / S2 / Diploma" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan / Program Studi</label>
            <input name="field_of_study" placeholder="Teknik Informatika" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Mulai</label>
                <input type="number" name="start_year" min="1950" max="2100" placeholder="2018" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Selesai</label>
                <input type="number" name="end_year" min="1950" max="2100" placeholder="2022" class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan / Prestasi (Opsional)</label>
            <textarea name="description" placeholder="Catatan atau prestasi akademik..." class="w-full rounded-lg border border-slate-300 px-3 py-2 h-20"></textarea>
        </div>
        <button type="submit" class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Tambah Pendidikan</button>
    </form>

    @if($educations->count())
        <div class="space-y-3">
            <p class="text-sm font-medium text-slate-700">Riwayat Pendidikan:</p>
            @foreach($educations as $education)
                <div class="rounded-lg border border-slate-200 p-3">
                    <p class="font-semibold text-slate-900">{{ $education->school_name }}</p>
                    <p class="text-sm text-slate-600">{{ $education->degree }}{{ $education->field_of_study ? ' - ' . $education->field_of_study : '' }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $education->start_year ?? '-' }} - {{ $education->end_year ?? 'Sekarang' }}</p>
                    @if($education->description)
                        <p class="text-sm text-slate-700 mt-2">{{ $education->description }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const maxSkills = 5;
    const skillDropdown = document.getElementById('skill-dropdown');
    const container = document.getElementById('selected-skills-container');
    const profileForm = document.getElementById('profile-form');

    // Validate form before submit
    profileForm.addEventListener('submit', function (e) {
        const selectedSkills = container.querySelectorAll('.skill-input').length;
        if (selectedSkills === 0) {
            e.preventDefault();
            alert('Harap pilih minimal 1 skill');
            return false;
        }
    });

    function updateChips() {
        const selectedIds = Array.from(container.querySelectorAll('.skill-input')).map(el => el.value);
        
        // Update dropdown options visibility
        Array.from(skillDropdown.options).forEach(option => {
            if (option.value === '') return; // Skip placeholder
            option.style.display = selectedIds.includes(option.value) ? 'none' : '';
        });

        // Disable dropdown if max reached
        skillDropdown.disabled = selectedIds.length >= maxSkills;
        if (selectedIds.length >= maxSkills && skillDropdown.value) {
            skillDropdown.value = '';
        }
    }

    // Handle skill selection from dropdown
    skillDropdown.addEventListener('change', function () {
        if (!this.value) return;

        const skillId = this.value;
        const skillName = this.options[this.selectedIndex].text;

        // Create hidden input
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'skills[]';
        hiddenInput.value = skillId;
        hiddenInput.className = 'skill-input';

        // Create chip button
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700 hover:bg-blue-200 skill-chip';
        chip.dataset.skillId = skillId;
        chip.innerHTML = `${skillName} <span class="font-bold">×</span>`;

        // Add click to remove
        chip.addEventListener('click', function (e) {
            e.preventDefault();
            chip.remove();
            hiddenInput.remove();
            updateChips();
        });

        container.appendChild(chip);
        container.appendChild(hiddenInput);

        this.value = '';
        updateChips();
    });

    // Handle click on existing chips to remove
    container.addEventListener('click', function (e) {
        if (e.target.closest('.skill-chip')) {
            e.preventDefault();
            const chip = e.target.closest('.skill-chip');
            const skillId = chip.dataset.skillId;
            
            // Remove the chip and its hidden input
            chip.remove();
            container.querySelector(`input[value="${skillId}"]`)?.remove();
            
            updateChips();
        }
    });

    updateChips();
});
</script>
@endsection
