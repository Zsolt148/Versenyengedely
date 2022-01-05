<div>
    @if($beforeTableSlot)
        <div class="mt-8">
            @include($beforeTableSlot)
        </div>
    @endif
    <div class="relative">
        <div class="flex justify-between items-center mb-1">
            <div class="flex-grow h-10 flex items-center">
                @if($this->searchableColumns()->count())
                <div class="w-full sm:w-7/12 flex rounded-lg shadow-sm">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 dark:text-white" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.debounce.500ms="search" class="form-input block bg-gray-50 dark:bg-gray-700 focus:bg-white dark:focus:bg-gray-700 dark:text-white w-full rounded-md pl-10 transition ease-in-out duration-150 p-2" placeholder="Keresés a(z) {{ $this->searchableColumns()->map->label->join(', ') }} sorokban" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button wire:click="$set('search', null)" class="text-gray-300 dark:text-white hover:text-red-600 focus:outline-none">
                                <x-icons.x-circle class="h-5 w-5 stroke-current" />
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if(session()->has('message'))
                {{session('message')}}
            @endif

            <div class="flex items-center space-x-1">
                <x-icons.cog wire:loading class="h-9 w-9 animate-spin text-gray-400 dark:text-white" />

                @if($exportable)
                <div x-data="{ init() {
                    window.livewire.on('startDownload', link => window.open(link,'_blank'))
                } }" x-init="init">
                    <button wire:click="export" class="flex items-center space-x-2 px-3 border border-green-400 rounded-md bg-white dark:bg-gray-800 text-green-500 dark:text-green-200 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-green-200 dark:hover:bg-green-600 focus:outline-none"><span>Mentés</span>
                        <x-icons.excel class="m-2" /></button>
                </div>
                @endif
                @isset($customExport)
                    <div>
                        <a href="{{ route($customExport) }}" class="flex items-center space-x-2 px-3 border border-green-400 rounded-md bg-white dark:bg-gray-800 text-green-500 dark:text-green-200 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-green-200 dark:hover:bg-green-600 focus:outline-none"><span>Mentés</span>
                            <x-icons.excel class="m-2" /></a>
                    </div>
                @endisset

                @if($hideable === 'select')
                    @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        @if($hideable === 'buttons')
        <div class="p-2 grid grid-cols-8 gap-2">
            @foreach($this->columns as $index => $column)
            <button wire:click.prefetch="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white dark:text-white text-xs focus:outline-none
            {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                {{ $column['label'] }}
            </button>
            @endforeach
        </div>
        @endif

        <div class="rounded-lg shadow-sm bg-white dark:bg-gray-700 max-w-screen overflow-x-scroll">
            <div class="rounded-lg @unless($this->hidePagination) rounded-b-none @endif">
                <div class="table align-middle min-w-full">
                    @unless($this->hideHeader)
                    <div class="table-row divide-x divide-gray-200 dark:bg-gray-700">
                        @foreach($this->columns as $index => $column)
                            @if($hideable === 'inline')
                                @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                            @elseif($column['type'] === 'checkbox')
                            <div class="relative table-cell h-6  w-24 overflow-hidden align-top px-2 py-2 border-b border-gray-200 dark:border-gray-900 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-white tracking-wider flex items-center focus:outline-none">
                                <div class="px-3 py-1 rounded @if(count($selected)) bg-gray-200 dark:bg-gray-500 @else bg-gray-300 dark:bg-gray-600 @endif text-black dark:text-white text-center">
                                    {{ count($selected) }}
                                </div>
                            </div>
                            @else
                                @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                            @endif
                        @endforeach
                    </div>

                    <div class="table-row divide-x divide-gray-200 bg-gray-50 dark:bg-gray-700">
                        @foreach($this->columns as $index => $column)
                            @if($column['hidden'])
                                @if($hideable === 'inline')
                                    <div class="table-cell w-5 overflow-hidden align-top bg-blue-100 dark:bg-blue-600"></div>
                                @endif
                            @elseif($column['type'] === 'checkbox')
                                <div class="overflow-hidden align-top bg-blue-100 dark:bg-gray-600 px-2 py-2 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-800 dark:text-white uppercase tracking-wider flex h-full flex-col items-center space-y-2 focus:outline-none">
                                    <div>Összes</div>
                                    <div>
                                        <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected) === $this->results->total()) checked @endif class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    </div>
                                </div>
                            @else
                                <div class="table-cell overflow-hidden align-top">
                                    @isset($column['filterable'])
                                        @if( is_iterable($column['filterable']) )
                                            <div wire:key="{{ $index }}">
                                                @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                            </div>
                                        @else
                                            <div wire:key="{{ $index }}">
                                                @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                            </div>
                                        @endif
                                    @endisset
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                    @forelse($this->results as $result)
                        <div class="table-row p-1 divide-x divide-gray-100 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-gray-300 dark:bg-gray-500' : ($loop->even ? 'bg-gray-100 dark:bg-gray-700' : 'bg-gray-50 dark:bg-gray-600') }}">
                            @foreach($this->columns as $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                    <div class="table-cell w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                                @else
                                    <div class="px-2 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-white table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        {!! $result->{$column['name']} !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @empty
                        <p class="p-3 text-lg text-teal-600">
                           Nincs találat
                        </p>
                    @endforelse
                </div>
            </div>
            @unless($this->hidePagination)
            <div class="rounded-lg rounded-t-none max-w-screen rounded-lg border-b border-gray-200 dark:border-gray-200 bg-white dark:bg-gray-700">
                <div class="p-2 sm:flex items-center justify-between">
                    {{-- check if there is any data --}}
                    @if($this->results[1])
                        <div class="my-2 sm:my-0 flex items-center">
                            <select name="perPage" class="mt-1 form-select rounded-md block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 dark:border-gray-200 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" wire:model="perPage">
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="99999999">Összes</option>
                            </select>
                        </div>

                        <div class="my-4 sm:my-0">
                            <div class="lg:hidden">
                                <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                            </div>

                            <div class="hidden lg:flex justify-center">
                                <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-end text-gray-800 dark:text-white">
                            Mutatva {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} a
                            {{ $this->results->total() }} -ből
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @if($afterTableSlot)
    <div class="mt-8">
        @include($afterTableSlot)
    </div>
    @endif
</div>
