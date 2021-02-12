<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Új versenyengedély kérelem
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-600">
                <div class="mt-3 text-2xl">
                    VERSENYENGEDÉLY-KÉRŐ LAP – {{ now()->format('Y') }}
                </div>
                <div class="mb-6 text-sm text-gray-600 dark:text-gray-300">
                    A csillagalt jelölt mezők kitöltése kötelező az igénylés benyújtásához!<br>
                    Menteni bármikor lehet.
                </div>
                @livewire('forms-create')
            </div>
        </div>
    </div>

</x-app-layout>
