@props(['status' => 'default', 'class' => ''])

@php
$statusColors = [
    'applied' => 'bg-blue-100 text-blue-700 border border-blue-200',
    'review' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
    'interview' => 'bg-purple-100 text-purple-700 border border-purple-200',
    'rejected' => 'bg-red-100 text-red-700 border border-red-200',
    'hired' => 'bg-green-100 text-green-700 border border-green-200',
    'approved' => 'bg-green-100 text-green-700 border border-green-200',
    'pending' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
    'suspended' => 'bg-red-100 text-red-700 border border-red-200',
    'active' => 'bg-green-100 text-green-700 border border-green-200',
    'inactive' => 'bg-gray-100 text-slate-600 border border-gray-200',
    'default' => 'bg-gray-100 text-slate-600 border border-gray-200',
];

$color = $statusColors[$status] ?? $statusColors['default'];
@endphp

<span class="inline-block rounded-full {{ $color }} px-3 py-1 text-xs font-semibold {{ $class }}">
    {{ $slot }}
</span>
