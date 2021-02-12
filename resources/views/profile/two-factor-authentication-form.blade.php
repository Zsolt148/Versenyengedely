<x-jet-action-section>
    <x-slot name="title">
        Kétfaktoros hitelesítés
    </x-slot>

    <x-slot name="description">
        {{ __('Adj hozzá extra védelmet a fiókodhoz a kétfaktoros hitelesítéssel') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
            @if ($this->enabled)
                {{ __('Kétfaktoros hitelesítés bekapcsolva') }}
            @else
                {{ __('Nincs bekapcsolva a kétfaktoros hitelesítés') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-300">
            <p>
                {{ __('Amikor bekapcsolod a kétfaktoros hitelesítést, akkor csak egy biztonságos, random tokennel léphetsz majd be az oldalra. Ezt a tokent a telefonod Google Hitelesítő alkalmazásban nézheted meg csak.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                    <p class="font-semibold">
                        {{ __('Bekapcsoltad a kétfaktoros hitelesítést. Szkenneld be a telefonoddal a QR kódot.') }}
                    </p>
                </div>

                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                    <p class="font-semibold">
                        {{ __('Mentsd el ezeket a visszaállító kódokat egy jelszó kezelőbe. Ezzekkel a kódokkal állíthatod vissza a fiókod ha elveszíted a Google hitelesítő alkalmazást.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-700 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Bekapcsolás') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Új visszaállító kódok') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Visszaállító kódok') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Kikapcsolás') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
