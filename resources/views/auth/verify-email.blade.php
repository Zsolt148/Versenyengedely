<x-guest-layout>
    <x-jet-authentication-card>

        <div class="mb-4 text-gray-600 dark:text-gray-200">
            <span class="text-lg">Köszönjük a regisztrációdat! </span><br><br>
            Kérjük erősítsd meg az <span class="text-indigo-500">Email címed</span> a gombra kattintva abban az emailben amit az imént küldtünk neked.<br><br>
            <span class="text-sm">Ha nem kaptál emailt, akkor a lenti gombra kattintva kérhetsz egy újat.</span>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-green-600">
                Elküldtünk egy új megerősítő emailt a regisztrációkor megadott email címedre. A spam mappát is ellenőrizd!
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Email újra küldése') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900">
                    {{ __('Kijelentkezés') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
