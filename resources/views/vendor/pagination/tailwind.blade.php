@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mt-8">
        <div class="text-sm text-gray-600">
            Showing <span class="font-semibold">{{ $paginator->firstItem() }}</span> to <span class="font-semibold">{{ $paginator->lastItem() }}</span> of <span class="font-semibold">{{ $paginator->total() }}</span> learners
        </div>

        <div class="flex items-center gap-2 flex-wrap justify-center md:justify-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}&per_page={{ request('per_page', 5) }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">Previous</a>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex items-center gap-1">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-2 text-white bg-blue-600 rounded-lg font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}&per_page={{ request('per_page', 5) }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}&per_page={{ request('per_page', 5) }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">Next</a>
            @else
                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
@endif
