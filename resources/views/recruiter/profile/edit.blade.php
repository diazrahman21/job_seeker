@extends('layouts.recruiter', ['title' => 'Profile Perusahaan'])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Profile Perusahaan</h2>
        <p class="text-slate-500 mt-1">Kelola informasi dan data perusahaan Anda</p>
    </div>

    <!-- Profile Form -->
    <x-card>
        <form action="{{ route('recruiter.profile.update') ?? '#' }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Logo Upload -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Logo Perusahaan</label>
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-xl bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if($company && $company->logo)
                        <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                        <x-icon name="building-office-2" class="w-8 h-8 text-gray-400" />
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-slate-700 file:mr-4 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-100 file:text-blue-600 hover:file:bg-blue-200" onchange="previewLogo(event)">
                        <p class="text-xs text-slate-500 mt-1">Max 2MB. Format: JPG, PNG</p>
                    </div>
                </div>
            </div>

            <!-- Nama Perusahaan -->
            <x-input 
                name="name" 
                label="Nama Perusahaan"
                placeholder="PT. Contoh Indonesia"
                :value="old('name', $company->name ?? '')"
                :error="$errors->first('name')"
                required
            />

            <!-- Website -->
            <x-input 
                name="website" 
                label="Website"
                type="url"
                placeholder="https://www.contoh.com"
                :value="old('website', $company->website ?? '')"
                :error="$errors->first('website')"
            />

            <!-- Lokasi -->
            <x-input 
                name="location" 
                label="Lokasi / Alamat"
                placeholder="Jakarta, Indonesia"
                :value="old('location', $company->location ?? '')"
                :error="$errors->first('location')"
            />

            <!-- Industri -->
            <x-input 
                name="industry" 
                label="Industri"
                type="select"
                :value="old('industry', $company->industry ?? '')"
                :error="$errors->first('industry')"
            >
                <option value="">-- Pilih Industri --</option>
                <option value="Technology">Technology</option>
                <option value="Finance">Finance</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Retail">Retail</option>
                <option value="Manufacturing">Manufacturing</option>
                <option value="Education">Education</option>
                <option value="Other">Other</option>
            </x-input>

            <!-- Ukuran Perusahaan -->
            <x-input 
                name="company_size" 
                label="Ukuran Perusahaan"
                type="select"
                :value="old('company_size', $company->company_size ?? '')"
                :error="$errors->first('company_size')"
            >
                <option value="">-- Pilih Ukuran --</option>
                <option value="1-10">1-10 karyawan</option>
                <option value="11-50">11-50 karyawan</option>
                <option value="51-200">51-200 karyawan</option>
                <option value="201-500">201-500 karyawan</option>
                <option value="500+">500+ karyawan</option>
            </x-input>

            <!-- Deskripsi Perusahaan -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Perusahaan</label>
                <textarea 
                    name="description" 
                    rows="6" 
                    placeholder="Jelaskan tentang perusahaan Anda, visi, misi, dan budaya kerja..."
                    class="w-full border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-3"
                >{{ old('description', $company->description ?? '') }}</textarea>
                @if($errors->has('description'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                <h4 class="font-semibold text-slate-900 mb-3">Informasi Kontak</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="contact_name" 
                        label="Nama Kontak"
                        placeholder="Nama PIC"
                        :value="old('contact_name', $company->contact_name ?? '')"
                        :error="$errors->first('contact_name')"
                    />
                    
                    <x-input 
                        name="contact_phone" 
                        label="Telepon Kontak"
                        type="tel"
                        placeholder="081234567890"
                        :value="old('contact_phone', $company->contact_phone ?? '')"
                        :error="$errors->first('contact_phone')"
                    />
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <x-button type="submit" variant="primary">
                    <span class="flex items-center gap-2">
                        <x-icon name="check-circle" class="w-5 h-5" />
                        Simpan Perubahan
                    </span>
                </x-button>
                <a href="{{ route('recruiter.dashboard') }}" class="px-6 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors font-medium text-center no-underline">
                    Batal
                </a>
            </div>
        </form>
    </x-card>

    <!-- Danger Zone -->
    <x-card title="Danger Zone" class="border-l-4 border-l-red-500">
        <div class="space-y-4">
            <p class="text-sm text-slate-600">
                Hapus akun perusahaan Anda. Tindakan ini tidak dapat dibatalkan.
            </p>
            <button 
                type="button"
                onclick="if(confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.')) document.getElementById('delete-form').submit();"
                class="px-6 py-2.5 rounded-xl bg-red-500 text-white hover:bg-red-600 transition-colors font-medium"
            >
                Hapus Akun
            </button>
            <form id="delete-form" action="{{ route('recruiter.profile.destroy') ?? '#' }}" method="POST" class="hidden">
                @csrf @method('DELETE')
            </form>
        </div>
    </x-card>
</div>

<script>
    function previewLogo(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.w-20.h-20 img') 
                    ? document.querySelector('.w-20.h-20 img').src = e.target.result
                    : null;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
