@props(['id', 'title' => 'Modal', 'size' => 'md'])

@php
$sizes = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div id="{{ $id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-lg {{ $sizeClass }} w-full">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
            <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <x-icon name="x-circle" class="w-5 h-5" />
            </button>
        </div>
        <div class="px-6 py-4">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    window.openModal = function(id) {
        document.getElementById(id).classList.remove('hidden');
    };
    window.closeModal = function(id) {
        document.getElementById(id).classList.add('hidden');
    };
</script>
