@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Profil Perusahaan</h1>

<div class="space-y-4">
    <div class="rounded-xl border bg-white p-6">
        <h2 class="mb-4 text-lg font-semibold">Informasi Perusahaan</h2>
        <form method="post" action="{{ route('recruiter.profile.update') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Perusahaan <span class="text-rose-600">*</span></label>
                <input name="name" value="{{ old('name', $company->name) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                @error('name')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
            </div>

            <div class="grid gap-3 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Lokasi <span class="text-rose-600">*</span></label>
                    <input name="location" value="{{ old('location', $company->location) }}" placeholder="Contoh: Jakarta" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                    @error('location')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Industri <span class="text-rose-600">*</span></label>
                    <select name="industry" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                        <option value="">-- Pilih Industri --</option>
                        <option value="Teknologi Informasi" {{ old('industry', $company->industry) === 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Fintech" {{ old('industry', $company->industry) === 'Fintech' ? 'selected' : '' }}>Fintech</option>
                        <option value="E-Commerce" {{ old('industry', $company->industry) === 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
                        <option value="SaaS" {{ old('industry', $company->industry) === 'SaaS' ? 'selected' : '' }}>SaaS</option>
                        <option value="Media Digital" {{ old('industry', $company->industry) === 'Media Digital' ? 'selected' : '' }}>Media Digital</option>
                        <option value="Game Development" {{ old('industry', $company->industry) === 'Game Development' ? 'selected' : '' }}>Game Development</option>
                        <option value="IoT" {{ old('industry', $company->industry) === 'IoT' ? 'selected' : '' }}>IoT</option>
                        <option value="Cloud Services" {{ old('industry', $company->industry) === 'Cloud Services' ? 'selected' : '' }}>Cloud Services</option>
                        <option value="Konsultasi IT" {{ old('industry', $company->industry) === 'Konsultasi IT' ? 'selected' : '' }}>Konsultasi IT</option>
                        <option value="Cybersecurity" {{ old('industry', $company->industry) === 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                    </select>
                    @error('industry')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid gap-3 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ukuran Perusahaan <span class="text-rose-600">*</span></label>
                    <select name="company_size" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                        <option value="">-- Pilih Ukuran --</option>
                        <option value="1-50" {{ old('company_size', $company->company_size) === '1-50' ? 'selected' : '' }}>1-50 Karyawan</option>
                        <option value="51-200" {{ old('company_size', $company->company_size) === '51-200' ? 'selected' : '' }}>51-200 Karyawan</option>
                        <option value="201-500" {{ old('company_size', $company->company_size) === '201-500' ? 'selected' : '' }}>201-500 Karyawan</option>
                        <option value="501-1000" {{ old('company_size', $company->company_size) === '501-1000' ? 'selected' : '' }}>501-1000 Karyawan</option>
                        <option value="1000+" {{ old('company_size', $company->company_size) === '1000+' ? 'selected' : '' }}>1000+ Karyawan</option>
                    </select>
                    @error('company_size')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Berdiri <span class="text-rose-600">*</span></label>
                    <input type="number" name="founded_year" value="{{ old('founded_year', $company->founded_year) }}" min="1900" max="2100" placeholder="2020" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                    @error('founded_year')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Perusahaan <span class="text-rose-600">*</span></label>
                <textarea name="description" placeholder="Ceritakan tentang perusahaan Anda, visi, misi, dan nilai-nilai perusahaan..." class="w-full rounded-lg border border-slate-300 px-3 py-2 h-28" required minlength="20">{{ old('description', $company->description) }}</textarea>
                @error('description')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
            </div>

            <div class="grid gap-3 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Website</label>
                    <input name="website" type="url" value="{{ old('website', $company->website) }}" placeholder="https://www.perusahaan.id" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    @error('website')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon</label>
                    <input name="phone" value="{{ old('phone', $company->phone) }}" placeholder="+62..." class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    @error('phone')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Logo Perusahaan</label>
                <input name="logo" type="file" accept="image/*" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('logo')<span class="text-sm text-rose-600">{{ $message }}</span>@enderror
                @if($company->logo_path)
                    <p class="text-sm text-slate-500 mt-2">Logo saat ini sudah ada</p>
                @endif
            </div>

            <button type="submit" class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Simpan Profil</button>
        </form>
    </div>

    <div class="rounded-xl border bg-white p-6">
        <h2 class="mb-4 text-lg font-semibold">Media Sosial</h2>
        <form method="post" action="{{ route('recruiter.profile.update-social') }}" class="space-y-3">
            @csrf
            @php
                $socialMedia = json_decode($company->social_media, true) ?? [];
            @endphp
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn</label>
                <input name="linkedin" value="{{ old('linkedin', $socialMedia['linkedin'] ?? '') }}" placeholder="https://linkedin.com/company/..." class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Twitter/X</label>
                <input name="twitter" value="{{ old('twitter', $socialMedia['twitter'] ?? '') }}" placeholder="https://twitter.com/..." class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Instagram</label>
                <input name="instagram" value="{{ old('instagram', $socialMedia['instagram'] ?? '') }}" placeholder="https://instagram.com/..." class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>
            <button type="submit" class="rounded-lg bg-slate-900 px-6 py-2 text-white font-medium hover:bg-slate-800">Update Media Sosial</button>
        </form>
    </div>
</div>
@endsection
