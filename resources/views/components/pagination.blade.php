@if (isset($paginator))
    @php
        /*http_build_query($appends) = converssão das informações do array em formato de query http (url)*/
        $queryParams = (isset($appends) &&  gettype($appends) === 'array' && $appends['filter']) ? '&' . http_build_query($appends) : '';
    @endphp
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->isFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-sm">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="?page={{ $paginator->getPreviousPage() }}{{ $queryParams }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-sm hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if (!$paginator->isLastPage())
            <a href="?page={{ $paginator->getNextPage() }}{{ $queryParams }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-sm hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-sm">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
