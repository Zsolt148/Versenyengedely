<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Összes versenyegendély kérelem
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 dark:bg-gray-600">

                <div class="my-5 flex flex-col sm:flex-row flex-wrap">
                    <a role="button" href="{{ route('admin.forms.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                        Kérelmek feldolgozása
                    </a>

                    <div class="ml-2 mt-1">
                        <span class="text-sm text-gray-600 dark:text-gray-200">
                            Feldolgozásra váró engedélyek: {{ $formsCount }}
                        </span>
                    </div>
                </div>

                <livewire:admin.forms-table />
            </div>
        </div>
    </div>
</x-app-layout>
