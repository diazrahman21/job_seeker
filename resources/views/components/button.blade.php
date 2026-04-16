@props(['variant' => 'primary', 'size' => 'md', 'disabled' => false, 'class' => ''])

@php
$baseClasses = 'rounded-xl font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 disabled:bg-blue-300',
    'secondary' => 'bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-300 disabled:bg-gray-50',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 focus:ring-red-400 disabled:bg-red-300',
    'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 disabled:bg-green-300',
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
