<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Sportolók
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 dark:bg-gray-600">
                @livewire('admin.competitors')
            </div>
            @if(auth()->user()->isSuper())
                <x-jet-section-border/>
                <div class="bg-white shadow overflow-hidden sm:rounded-md p-4 dark:bg-gray-600">
                    <div class="text-lg my-4">
                        Sportolók importálása
                        @if (session('status'))
                            <div class="font-bold text-green-600 dark:text-green-300">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-200 px-6 py-4 my-2 rounded-md flex items-center w-1/4">
                            <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                                <path fill="currentColor"
                                      d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path>
                            </svg>
                            <span class="text-red-800">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </span>
                        </div>
                    @endif
                    <div class="mt-4 mb-2">
                        <span class="text-gray-600 dark:text-gray-200 text-sm">Az első sor <u>NE</u> tartalmazza az oszlopok leírását!</span><br>
                        <span class="text-gray-600 dark:text-gray-200 text-sm">A csillagalt jelölt mezők nem lehetnek üresek!</span><br>
                    </div>
                    <table
                        class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 border-collapse table-auto rounded-lg shadow-lg">
                        <thead>
                        <tr>
                            <th class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 text-gray-700 dark:text-white">Szövetségi regisztrációs kód*</th>
                            <th class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 text-gray-700 dark:text-white">Egyesületi regisztrációs kód*</th>
                            <th class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 text-gray-700 dark:text-white">Teljes név*</th>
                            <th class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 text-gray-700 dark:text-white">Születési éve*</th>
                            <th class="border-gray-300 border p-3 font-bold bg-gray-100 dark:bg-gray-500 text-gray-700 dark:text-white">Egyesület*</th>
                        </tr>
                        </thead>
                    </table>
                    <form action="{{ route('admin.competitorsUpload') }}" method="post" enctype="multipart/form-data"
                          class="my-4 w-1/2">
                        @csrf
                        @method('POST')
                        <div class="grid grid-cols-6">
                            <div class="col-span-3">
                                <x-jet-label for="file" value="{{ __('Fájl (.csv vagy .txt)') }}"/>
                                <input type="file" class="custom-file-input" id="file" name="file"
                                       aria-describedby="input" lang="hu-hu" required>
                            </div>
                            <div class="col-span-2">
                                <x-jet-button class="mt-3">Feltöltés</x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>
