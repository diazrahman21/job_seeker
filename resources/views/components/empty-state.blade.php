@props(['title' => 'Belum ada data', 'description' => '', 'icon' => 'document', 'buttonText' => null, 'buttonUrl' => null])

@php
$iconMap = [
    'document' => 'document',
    'search' => 'magnifying-glass',
    'users' => 'users',
    'briefcase' => 'briefcase',
    'inbox' => 'inbox',
];
$iconName = $iconMap[$icon] ?? 'document';
@endphp

<div class="flex flex-col items-center justify-center py-12 text-center">
    <div class="mb-4 text-blue-600 bg-blue-50 p-4 rounded-full">
        <x-icon :name="$iconName" class="w-12 h-12 mx-auto" />
    </div>
    <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $title }}</h3>
    @if($description)
    <p class="text-slate-600 mb-6 max-w-sm">{{ $description }}</p>
    @endif
    @if($buttonText && $buttonUrl)
    <a href="{{ $buttonUrl }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
        {{ $buttonText }}
    </a>
    @endif
</div>
