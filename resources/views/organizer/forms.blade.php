<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Regisztrált szenior úszó versenyzők nyilvántartása
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 dark:bg-gray-600">
                @livewire('organizer.competitors')
            </div>
        </div>
    </div>

</x-app-layout>
