@props(['title' => null, 'class' => ''])

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 {{ $class }}">
    @if($title)
    <div class="border-b border-gray-200 px-6 py-4">
        <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
    </div>
    @endif
    <div class="@if($title) px-6 py-4 @else p-6 @endif">
        {{ $slot }}
    </div>
</div>
