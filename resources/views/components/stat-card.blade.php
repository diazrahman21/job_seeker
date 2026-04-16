@props([
    'title',
    'value',
    'icon' => 'chart-bar',
    'trend' => null, // +5% or -3%
    'trendType' => 'positive', // positive or negative
])

<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
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
        <div class="text-blue-100">
            <x-icon :name="$icon" class="w-12 h-12" />
        </div>
    </div>
</div>
