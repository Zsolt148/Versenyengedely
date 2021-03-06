<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-300 cursor-default leading-5 rounded-md">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-white bg-white dark:bg-gray-600 border border-gray-300 leading-5 rounded-md hover:text-gray-500 dark:hover:text-gray-200 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 dark:active:bg-gray-700 active:text-gray-700 dark:active:text-white transition ease-in-out duration-150">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-white bg-white dark:bg-gray-600 border border-gray-300 leading-5 rounded-md hover:text-gray-500 dark:hover:text-gray-200 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 dark:active:bg-gray-700 active:text-gray-700 dark:active:text-white transition ease-in-out duration-150">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-300 cursor-default leading-5 rounded-md">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
