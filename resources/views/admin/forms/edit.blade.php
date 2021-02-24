<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Versenyengedély feldolgozása:
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            @livewire('admin.forms-edit', ["id" => request()->id])
        </div>
    </div>
</x-app-layout>
