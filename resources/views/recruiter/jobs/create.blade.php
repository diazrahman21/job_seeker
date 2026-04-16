@extends('layouts.recruiter', ['title' => 'Buat Lowongan Baru'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Buat Lowongan Baru</h2>
        <p class="text-slate-500 mt-1">Isi informasi lowongan dengan lengkap</p>
    </div>

    <!-- Form -->
    <x-card>
        <form action="{{ route('recruiter.jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Judul -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input 
                    name="title" 
                    label="Judul Lowongan"
                    placeholder="Contoh: Senior Backend Developer"
                    :value="old('title')"
                    :error="$errors->first('title')"
                    required
                />
                
                <x-input 
                    name="job_type" 
                    label="Tipe Pekerjaan"
                    type="select"
                    :value="old('job_type')"
                    :error="$errors->first('job_type')"
                    required
                >
                    <option value="">-- Pilih Tipe --</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Freelance">Freelance</option>
                </x-input>
            </div>

            <!-- Lokasi & Salary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-input 
                    name="location" 
                    label="Lokasi"
                    placeholder="Jakarta, Indonesia"
                    :value="old('location')"
                    :error="$errors->first('location')"
                    required
                />
                
                <x-input 
                    name="salary_min" 
                    label="Gaji Minimum (Rp)"
                    type="number"
                    placeholder="5000000"
                    :value="old('salary_min')"
                    :error="$errors->first('salary_min')"
                />
                
                <x-input 
                    name="salary_max" 
                    label="Gaji Maksimum (Rp)"
                    type="number"
                    placeholder="15000000"
                    :value="old('salary_max')"
                    :error="$errors->first('salary_max')"
                />
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Pekerjaan</label>
                <textarea 
                    name="description" 
                    rows="6" 
                    placeholder="Jelaskan detail pekerjaan, tanggung jawab, dan benefit..."
                    class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-3"
                    required
                >{{ old('description') }}</textarea>
                @if($errors->has('description'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <!-- Requirements -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Requirement / Persyaratan</label>
                <textarea 
                    name="requirements" 
                    rows="5" 
                    placeholder="- Berpengalaman minimal 3 tahun&#10;- Memahami Laravel, MySQL&#10;- Komunikasi baik"
                    class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-3"
                    required
                >{{ old('requirements') }}</textarea>
                @if($errors->has('requirements'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('requirements') }}</p>
                @endif
            </div>

            <!-- Deadline -->
            <x-input 
                name="deadline" 
                label="Deadline Lamaran"
                type="date"
                :value="old('deadline')"
                :error="$errors->first('deadline')"
                required
            />

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <x-button type="submit" variant="primary">
                    <span class="flex items-center gap-2">
                        <x-icon name="check-circle" class="w-5 h-5" />
                        Simpan Lowongan
                    </span>
                </x-button>
                <a href="{{ route('recruiter.jobs.index') }}" class="px-6 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium text-center no-underline">
                    Batal
                </a>
            </div>
        </form>
    </x-card>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex gap-3">
            <x-icon name="information-circle" class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" />
            <div>
                <h4 class="font-semibold text-blue-900 mb-1">Tips Membuat Lowongan Menarik</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Tulis deskripsi yang jelas dan detail tentang posisi</li>
                    <li>• Sebutkan benefit dan fasilitas yang menarik</li>
                    <li>• Tentukan requirement yang realistis</li>
                    <li>• Lowongan akan ditinjau admin terlebih dahulu sebelum dipublikasikan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
