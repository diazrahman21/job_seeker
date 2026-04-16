@props(['title' => null, 'class' => ''])

<div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 transition-all duration-200 {{ $class }}">
    @if($title)
    <div class="border-b border-gray-100 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">{{ $title }}</h3>
    </div>
    @endif
    <div class="@if($title) px-6 py-5 @else p-6 @endif">
        {{ $slot }}
    </div>
</div>
