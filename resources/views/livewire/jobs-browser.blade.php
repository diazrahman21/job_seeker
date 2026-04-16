<div class="space-y-4">
    <div class="grid gap-3 md:grid-cols-3 lg:grid-cols-6">
        <input wire:model.live.debounce.300ms="q" type="text" placeholder="Cari posisi..." class="rounded-lg border-slate-300" />
        <select wire:model.live="location" class="rounded-lg border-slate-300">
            <option value="">Semua lokasi</option>
            @foreach ($locations as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        <select wire:model.live="category" class="rounded-lg border-slate-300">
            <option value="">Semua kategori</option>
            @foreach ($categories as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        <select wire:model.live="employment_type" class="rounded-lg border-slate-300">
            <option value="">Semua tipe</option>
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
            <option value="internship">Internship</option>
        </select>
        <input wire:model.live="salary_min" type="number" min="0" placeholder="Gaji min" class="rounded-lg border-slate-300" />
        <input wire:model.live="salary_max" type="number" min="0" placeholder="Gaji max" class="rounded-lg border-slate-300" />
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($jobs as $job)
            <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:shadow-md transition">
                <h3 class="text-lg font-semibold text-slate-900">{{ $job->title }}</h3>
                <p class="text-sm text-slate-500"><a href="{{ route('companies.profile', $job->company) }}" class="hover:text-blue-600 hover:underline font-medium">{{ $job->company->name }}</a> - {{ $job->location }}</p>
                <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ $job->description }}</p>
                <div class="mt-3 flex items-center justify-between text-sm">
                    <div class="space-y-1">
                        <span class="inline-block rounded bg-slate-100 px-2 py-1">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
                        <p class="text-slate-600"><span class="text-slate-500">Gaji:</span> <span class="font-semibold">{{ formatRupiah($job->salary_min) }} - {{ formatRupiah($job->salary_max) }}</span></p>
                    </div>
                    <a href="{{ route('job-seeker.jobs.detail', $job) }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Lihat Detail →</a>
                </div>
            </article>
        @empty
            <p class="text-sm text-slate-600">Tidak ada lowongan sesuai filter.</p>
        @endforelse
    </div>

    <div class="flex items-center justify-between">
        <button wire:click="goTo('{{ $prevCursor }}')" @disabled(!$prevCursor) class="rounded-lg border px-3 py-2 text-sm disabled:opacity-50">Sebelumnya</button>
        <button wire:click="goTo('{{ $nextCursor }}')" @disabled(!$nextCursor) class="rounded-lg border px-3 py-2 text-sm disabled:opacity-50">Berikutnya</button>
    </div>
</div>
