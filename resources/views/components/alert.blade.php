@props(['type' => 'success', 'message', 'icon' => true, 'dismissible' => true])

@php
$icons = [
    'success' => 'check-circle',
    'error' => 'x-circle',
    'warning' => 'exclamation-triangle',
    'info' => 'information-circle',
];

$colors = [
    'success' => ['bg' => 'bg-green-50', 'border' => 'border-green-200', 'text' => 'text-green-800'],
    'error' => ['bg' => 'bg-red-50', 'border' => 'border-red-200', 'text' => 'text-red-800'],
    'warning' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'text' => 'text-yellow-800'],
    'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-800'],
];

$color = $colors[$type] ?? $colors['info'];
$iconName = $icons[$type] ?? 'information-circle';
@endphp

<div class="alert alert-{{ $type }} rounded-2xl border {{ $color['border'] }} {{ $color['bg'] }} px-6 py-4 {{ $color['text'] }} shadow-sm animate-slide-in flex items-start gap-3">
    @if($icon)
    <x-icon :name="$iconName" class="w-6 h-6 flex-shrink-0 mt-0.5" />
    @endif
    
    <div class="flex-1">
        {{ $slot ?? $message }}
    </div>

    @if($dismissible)
    <button type="button" onclick="this.parentElement.style.display='none'" class="flex-shrink-0 hover:opacity-70 transition-opacity">
        <x-icon name="x-circle" class="w-6 h-6" />
    </button>
    @endif
</div>
