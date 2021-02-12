<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-700 dark:border-gray-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="block w-auto text-blue-600 dark:text-blue-500 text-xl font-bold">mszuosz.hu</div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:space-x-2 md:space-x-2 lg:space-x-4 xl:space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        Kezdőlap
                    </x-jet-nav-link>

                    @if(auth()->user()->type == 'organizer' || auth()->user()->type == 'admin' || auth()->user()->type == 'super')
                        <x-jet-nav-link href="{{ route('organizer.forms') }}" :active="request()->routeIs('organizer.forms')">
                            Versenyző lista
                        </x-jet-nav-link>
                    @endif

                    @if(auth()->user()->type == 'coach')
                        <x-jet-nav-link href="{{ route('coach.forms.index') }}" :active="request()->routeIs('coach.forms.*')">
                            Versenyengedély kérelmek
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('coach.licences') }}" :active="request()->routeIs('coach.licences')">
                            Versenyengedélyek
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('coach.payments') }}" :active="request()->routeIs('coach.payments')">
                            Számlák
                        </x-jet-nav-link>
                    @endif
                    @if(auth()->user()->type == 'admin' || auth()->user()->type == 'super')
                        <x-jet-nav-link href="{{ route('admin.forms.index') }}" :active="request()->routeIs('admin.forms.*')">
                            Versenyengedély kérelmek
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('admin.teams.index') }}" :active="request()->routeIs('admin.teams.index')">
                            Egyesületek
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('admin.competitors.index') }}" :active="request()->routeIs('admin.competitors.index')">
                            Sportolók
                        </x-jet-nav-link>
                    @endif
                    @if(auth()->user()->type == 'super')
                        <x-jet-nav-link href="{{ route('super.payments') }}" :active="request()->routeIs('super.payments')">
                            Számlák
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('super.users') }}" :active="request()->routeIs('super.users')">
                            Felhasználók
                        </x-jet-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center ml-0 sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-700 dark:text-gray-300 dark:hover:text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ auth()->user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Bejelentkezve: {{ \App\Models\User::TYPES[auth()->user()->type] }}
                            </div>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Fiók beállítás') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profil') }}
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100 dark:border-gray-400"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Kijelentkezés') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-200 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-500 focus:text-gray-500 dark:focus:text-gray-200 transition duration-150 ease-in-out">
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
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                Kezdőlap
            </x-jet-responsive-nav-link>

            @if(auth()->user()->type == 'organizer' || auth()->user()->type == 'admin' || auth()->user()->type == 'super')
                <x-jet-responsive-nav-link href="{{ route('organizer.forms') }}" :active="request()->routeIs('organizer.forms')">
                    Versenyző lista
                </x-jet-responsive-nav-link>
            @endif

            @if(auth()->user()->type == 'coach')
                <x-jet-responsive-nav-link href="{{ route('coach.forms.index') }}" :active="request()->routeIs('coach.forms.*')">
                    Versenyengedély kérelmek
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('coach.payments') }}" :active="request()->routeIs('coach.payments')">
                    Számlák
                </x-jet-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-100">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-300">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profil') }}
                </x-jet-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Kijelentkezés') }}
                    </x-jet-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
