@props([
    'name' => 'question-mark-circle',
    'class' => 'w-6 h-6',
])

@php
$icons = [
    // Navigation & Common
    'chart-bar' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
    'building-office-2' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8.97m0 0l7.848-3.289A4 4 0 0021 7.11V5a2 2 0 00-2-2H5a2 2 0 00-2 2v2.11a4 4 0 001.152 2.61L12 21zm0-8.97l-7.848-3.289A4 4 0 003 7.11m0 0V5a2 2 0 012-2h14a2 2 0 012 2v2.11a4 4 0 01-1.152 2.61M12 12.25a.75.75 0 100-1.5.75.75 0 000 1.5z"/></svg>',
    'briefcase' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m0 0L4 7m8 4v10l8-4v-10L12 11z"/></svg>',
    'users' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 8.024M12 4.354l2.828 3.67m0 0a4 4 0 11-5.656 5.656M9.172 8.024l-2.828 2.828m10.296-1.098a4.022 4.022 0 01-1.022 2.3m-6.15-8.75a4 4 0 110 8.048M9.172 8.024A4 4 0 017 12c0 1.657.895 3.106 2.172 3.89m8.328-2.956A4.002 4.002 0 0117 12c0 1.657-.895 3.106-2.172 3.89"/></svg>',
    'document-text' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
    'document' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>',
    'magnifying-glass' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>',
    'inbox' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>',
    
    // Status icons
    'check-circle' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.05h16.94a2 2 0 0 0 1.71-3.05L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>',
    'x-circle' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm3.5 7.5l-4.5 4.5 4.5 4.5-1.5 1.5-4.5-4.5-4.5 4.5-1.5-1.5 4.5-4.5-4.5-4.5 1.5-1.5 4.5 4.5 4.5-4.5 1.5 1.5z"/></svg>',
    'exclamation-triangle' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>',
    'information-circle' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>',
    
    // UI elements
    'cog-6-tooth' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.592a1 1 0 011 .94l.213 1.281c.063.374.313.686.645.87.074.041.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1 1 0 011.37.364l1.296 2.247a1 1 0 01-.364 1.372l-1.216.456c-.332.123-.68.066-1.006-.27a1.921 1.921 0 00-.464-.536c-.223-.186-.487-.266-.755-.266h-.016c-.338 0-.666.068-.969.196l-1.281.213a1 1 0 01-.94-1.11m0 0a1.921 1.921 0 00-.464-.536m0 0l-.22-.127c-.332-.196-.72-.257-1.075-.124l-1.217.456a1 1 0 00-.364 1.372l1.296 2.247a1 1 0 001.37.364l1.216-.456c.332-.123.68-.066 1.006.27m0 0a1.921 1.921 0 01.464.536m0 0l.22.127c.332.196.72.257 1.075.124l1.217-.456a1 1 0 001.364-1.372l-1.296-2.247a1 1 0 00-1.37-.364l-1.216.456c-.332.123-.68.066-1.006-.27"/></svg>',
    'lock-closed' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm6-10V7a3 3 0 00-3 3v1h6V7a3 3 0 00-3-3z"/></svg>',
    'clock' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'arrow-left-on-rectangle' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>',
];

$svg = $icons[$name] ?? $icons['document'];
@endphp

<svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    {!! $svg !!}
</svg>
