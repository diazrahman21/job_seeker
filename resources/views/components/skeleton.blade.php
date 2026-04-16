@props([
    'count' => 1,
    'type' => 'card', // card, line, table
])

@if($type === 'card')
    @for($i = 0; $i < $count; $i++)
    <div class="bg-white rounded-2xl shadow-sm p-6 animate-pulse">
        <div class="h-4 bg-gray-200 rounded w-3/4 mb-4"></div>
        <div class="h-8 bg-gray-200 rounded w-1/2 mb-3"></div>
        <div class="h-3 bg-gray-100 rounded w-2/3"></div>
    </div>
    @endfor
@elseif($type === 'line')
    @for($i = 0; $i < $count; $i++)
    <div class="h-4 bg-gray-200 rounded animate-pulse mb-3"></div>
    @endfor
@elseif($type === 'table')
    <div class="bg-white rounded-2xl shadow-sm p-6 animate-pulse">
        <div class="h-10 bg-gray-200 rounded mb-4"></div>
        @for($i = 0; $i < 5; $i++)
        <div class="h-12 bg-gray-100 rounded mb-2"></div>
        @endfor
    </div>
@endif
