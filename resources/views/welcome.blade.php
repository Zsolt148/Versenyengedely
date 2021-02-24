<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Versenyengedélyek | mszuosz.hu</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-700 dark:border-gray-900">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}">
                                <div class="block w-auto text-blue-600 dark:text-blue-500 text-xl font-bold">mszuosz.hu</div>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-jet-nav-link href="{{ url('/') }}" :active="true">
                                Kezdőlap
                            </x-jet-nav-link>
                        </div>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('login') }}" :active="false">
                            Bejelentkezés
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('register')  }}" :active="false">
                            Regisztráció
                        </x-jet-nav-link>
                    </div>


                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ url('/') }}" :active="true">
                        Kezdőlap
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('login') }}" :active="false">
                        Bejelentkezés
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('register') }}" :active="false">
                        Regisztráció
                    </x-jet-responsive-nav-link>
                </div>

            </div>
        </nav>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-800 sm:items-center sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 p-1">
                    <!--<img src="{{ asset('images/mszuosz_logo.jpg') }}" alt="logo" class="w-1/2">-->
                    <h2 class="text-3xl p-2 text-blue-600 dark:text-blue-500 font-bold">Versenyengedélyek szenior úszók számára</h2>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-700 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('register') }}" class="underline text-gray-900 dark:text-white">Regisztráció</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-200 text-sm">
                                    Minden regisztrációról az mszuosz.hu szövetség dönt.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-400 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-in-alt" class="w-8 h-8 text-gray-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('login') }}" class="underline text-gray-900 dark:text-white">Bejelentkezés</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-200 text-sm">
                                    E-mail címmel vagy Google fiókkal.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-400">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a
                                        href="https://mszuosz.hu/" target="_blank" class="underline text-gray-900 dark:text-white">mszuosz.hu</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-200 text-sm">
                                    A Magyar Szenior Úszók Országos Szövetségének <br>
                                    hivatalos weboldala
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-400 md:border-l flex">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="flex flex-col space-y-1">
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a href="/docs/Versenyengedely_cikk_20210221.pdf" target="_blank" class="ml-1 underline">Általános Tájékozató</a><span class="ml-2 rounded-full bg-gray-300 text-gray-800 px-2 py-1 text-xs font-bold">pdf</span></div>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a href="/docs/Versenyengedely_csapatvezetoi_meghatalmazas.docx"class="ml-1 underline">Meghatalmazás csapatvezetőnek</a><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">docx</span></div>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a href="/docs/Versenyengedelykero_lap_MSZUOSZ_2021.pdf" target="_blank" class="ml-1 underline">Versenyengedélykérő lap</a><span class="ml-2 rounded-full bg-gray-300 text-gray-800 px-2 py-1 text-xs font-bold">pdf</span></div>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a href="/docs/Versenyengedelykero_lap_MSZUOSZ_2021.docx" class="ml-1 underline">Versenyengedélykérő lap</a><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">docx</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 mb-10 sm:mb-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-700 dark:text-white sm:text-left">
                        <div class="flex items-center">

                            <a href="{{ route('policy.show') }}" class="ml-1 underline">
                                Adatvédelmi Irányelvek
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
