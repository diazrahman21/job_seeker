@props(['message' => 'Berhasil!', 'type' => 'success'])

@php
$typeConfig = [
    'success' => ['bg' => 'bg-green-50', 'border' => 'border-green-200', 'text' => 'text-green-800', 'icon' => 'check-circle'],
    'error' => ['bg' => 'bg-red-50', 'border' => 'border-red-200', 'text' => 'text-red-800', 'icon' => 'x-circle'],
    'warning' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'text' => 'text-yellow-800', 'icon' => 'exclamation-triangle'],
    'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-800', 'icon' => 'information-circle'],
];

$config = $typeConfig[$type] ?? $typeConfig['success'];
@endphp

<div class="fixed bottom-4 right-4 {{ $config['bg'] }} border {{ $config['border'] }} {{ $config['text'] }} px-6 py-4 rounded-2xl shadow-lg flex items-center gap-3 animate-slide-in z-50 max-w-sm">
    <x-icon :name="$config['icon']" class="w-6 h-6 flex-shrink-0" />
    <span class="text-sm font-medium">{{ $message }}</span>
    <button type="button" onclick="this.parentElement.style.display='none'" class="ml-2 hover:opacity-70 transition-opacity">
        <x-icon name="x-circle" class="w-5 h-5" />
    </button>
</div>
