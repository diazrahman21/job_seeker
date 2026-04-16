@props([
    'title',
    'value',
    'icon' => 'chart-bar',
    'trend' => null, // +5% or -3%
    'trendType' => 'positive', // positive or negative
])

<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600 mb-2">{{ $title }}</p>
            <p class="text-3xl font-bold text-slate-900">{{ $value }}</p>
            @if($trend)
            <p class="text-xs mt-2 {{ $trendType === 'positive' ? 'text-green-600' : 'text-red-600' }}">
                {{ $trendType === 'positive' ? '↑' : '↓' }} {{ $trend }}
            </p>
            @endif
        </div>
        <div class="text-blue-600 bg-blue-50 p-3 rounded-lg">
            <x-icon :name="$icon" class="w-8 h-8" />
        </div>
    </div>
</div>
