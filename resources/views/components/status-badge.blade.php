@props([
    'status' => 'applied',
    'size' => 'md',
    'icon' => true,
])

@php
$statusMap = [
    'applied' => [
        'bg' => 'bg-blue-100',
        'text' => 'text-blue-800',
        'icon' => 'document-text',
        'label' => 'Applied'
    ],
    'review' => [
        'bg' => 'bg-yellow-100',
        'text' => 'text-yellow-800',
        'icon' => 'magnifying-glass',
        'label' => 'Under Review'
    ],
    'interview' => [
        'bg' => 'bg-purple-100',
        'text' => 'text-purple-800',
        'icon' => 'users',
        'label' => 'Interview'
    ],
    'rejected' => [
        'bg' => 'bg-red-100',
        'text' => 'text-red-800',
        'icon' => 'x-circle',
        'label' => 'Rejected'
    ],
    'hired' => [
        'bg' => 'bg-green-100',
        'text' => 'text-green-800',
        'icon' => 'check-circle',
        'label' => 'Hired'
    ],
    'pending' => [
        'bg' => 'bg-yellow-100',
        'text' => 'text-yellow-800',
        'icon' => 'clock',
        'label' => 'Pending'
    ],
    'active' => [
        'bg' => 'bg-green-100',
        'text' => 'text-green-800',
        'icon' => 'check-circle',
        'label' => 'Active'
    ],
    'inactive' => [
        'bg' => 'bg-gray-100',
        'text' => 'text-gray-800',
        'icon' => 'x-circle',
        'label' => 'Inactive'
    ],
    'suspended' => [
        'bg' => 'bg-red-100',
        'text' => 'text-red-800',
        'icon' => 'lock-closed',
        'label' => 'Suspended'
    ],
];

$current = $statusMap[$status] ?? $statusMap['applied'];
$sizeClass = $size === 'sm' ? 'px-2 py-1 text-xs' : ($size === 'lg' ? 'px-4 py-2 text-sm' : 'px-3 py-1.5 text-sm');
@endphp

<span class="inline-flex items-center gap-1 {{ $current['bg'] }} {{ $current['text'] }} {{ $sizeClass }} rounded-full font-medium whitespace-nowrap">
    @if($icon)
        <x-icon :name="$current['icon']" class="w-4 h-4" />
    @endif
    {{ $current['label'] }}
</span>
