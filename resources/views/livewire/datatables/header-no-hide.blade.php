@if($column['hidden'])
@else
<div class="relative table-cell h-12 overflow-hidden align-top">
    <button wire:click.prefetch="sort('{{ $index }}')" class="w-full h-full px-6 py-3 border-b border-gray-200 dark:border-white bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-700 dark:text-white uppercase tracking-wider flex items-center focus:outline-none @if($column['align'] === 'right') flex justify-end @elseif($column['align'] === 'center') flex justify-center @endif">
        <span class="inline ">{{ str_replace('_', ' ', $column['label']) }}</span>
        <span class="inline text-xs text-blue-400">
            @if($sort === $index)
            @if($direction)
            <x-icons.chevron-up class="text-blue-500" />
            @else
            <x-icons.chevron-down class="text-blue-500" />
            @endif
            @endif
        </span>
    </button>
</div>
@endif
