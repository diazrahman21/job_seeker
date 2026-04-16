@props(['status' => 'default', 'class' => ''])

@php
$statusColors = [
    'applied' => 'bg-blue-100 text-blue-800',
    'review' => 'bg-yellow-100 text-yellow-800',
    'interview' => 'bg-purple-100 text-purple-800',
    'rejected' => 'bg-red-100 text-red-800',
    'hired' => 'bg-green-100 text-green-800',
    'approved' => 'bg-green-100 text-green-800',
    'pending' => 'bg-yellow-100 text-yellow-800',
    'suspended' => 'bg-red-100 text-red-800',
    'active' => 'bg-green-100 text-green-800',
    'inactive' => 'bg-gray-100 text-gray-800',
    'default' => 'bg-gray-100 text-gray-800',
];

$color = $statusColors[$status] ?? $statusColors['default'];
@endphp

<span class="inline-block rounded-full {{ $color }} px-3 py-1 text-xs font-semibold {{ $class }}">
    {{ $slot }}
</span>
