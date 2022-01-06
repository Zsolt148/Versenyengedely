<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Összes versenyengedély kérelem
        </h2>
    </x-slot>

    @if($msg = Session::get('success'))
        <div class="mt-10 mx-auto w-full sm:w-1/2 justify-center" x-data="{ open: true }" x-show="open">
            <div class="flex sm:flex-row sm:items-center bg-white dark:bg-gray-600 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6">
                <div class="flex flex-row items-center border-b sm:border-b-0 w-1/2 sm:w-auto pb-4 sm:pb-0">
                    <div class="text-green-500">
                        <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-xl font-medium ml-3">Sikeres Online fizetés</div>
                </div>
                <div class="text-sm tracking-wide text-gray-600 dark:text-gray-200 mt-4 sm:mt-0 sm:ml-4">Köszönjük! Számlája elkészül amint megérkezik hozzánk az összeg!</div>
                <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-600 dark:text-gray-200 hover:text-gray-800 dark:hover:text-white cursor-pointer" @click="open = false">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 dark:bg-gray-600">
                <div class="mb-10 mt-5 flex flex-col sm:flex-row flex-wrap">
                    <div>
                        @if(Auth::user()->teams_id)
                            <a role="button" href="{{ route('coach.forms.create') }}" class="items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                                Új versenyengedély kérelem
                            </a>
                        @endif
                    </div>
                    <div class="mt-5 mb-2 sm:my-0 ml-0 sm:ml-4">
                        <a role="button" href="{{ route('coach.forms.cart') }}" class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-400 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Fizetés
                        </a>
                    </div>
                    <div class="ml-2">
                        <span class="text-sm text-gray-600 dark:text-gray-200">
                            Fizetésre váró engedélyek: {{ $formsCount }} db
                        </span>
                    </div>
                </div>

                <livewire:forms-table />
            </div>
        </div>
    </div>

</x-app-layout>
