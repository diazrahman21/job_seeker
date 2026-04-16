@props(['variant' => 'primary', 'size' => 'md', 'disabled' => false, 'class' => ''])

@php
$baseClasses = 'rounded-xl font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 shadow-sm hover:shadow-md',
    'secondary' => 'bg-gray-100 text-slate-700 hover:bg-gray-200 active:bg-gray-300 focus:ring-gray-300',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 active:bg-red-700 focus:ring-red-400 shadow-sm hover:shadow-md',
    'success' => 'bg-green-600 text-white hover:bg-green-700 active:bg-green-800 focus:ring-green-500 shadow-sm hover:shadow-md',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
];

$variantClass = $variants[$variant] ?? $variants['primary'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button 
    {{ $attributes }}
    @disabled($disabled)
    class="{{ $baseClasses }} {{ $variantClass }} {{ $sizeClass }} {{ $class }}"
>
    {{ $slot }}
</button>
