@if ($paginator->hasPages())
<div class="flex items-center justify-between px-4 py-6">
    <!-- Mobile view -->
    <div class="flex-1 flex md:hidden justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">← Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm font-medium no-underline">← Sebelumnya</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm font-medium no-underline">Berikutnya →</a>
        @else
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Berikutnya →</span>
        @endif
    </div>

    <!-- Desktop view -->
    <div class="hidden md:flex items-center justify-between w-full">
        <div class="text-sm text-slate-600">
            Menampilkan <strong>{{ $paginator->firstItem() }}</strong> hingga <strong>{{ $paginator->lastItem() }}</strong> dari <strong>{{ $paginator->total() }}</strong> hasil
        </div>

        <div class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed text-sm font-medium">← Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-50 text-slate-600 transition-colors text-sm font-medium no-underline">← Prev</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-600">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-50 text-slate-600 transition-colors text-sm font-medium no-underline">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-50 text-slate-600 transition-colors text-sm font-medium no-underline">Next →</a>
            @else
                <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed text-sm font-medium">Next →</span>
            @endif
        </div>
    </div>
</div>
@endif
