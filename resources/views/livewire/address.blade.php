<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-600 mt-10">
        @if(!$team_address)
        <div class="flex flex-row justify-center my-auto">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <div class="text-xl">Számla adatai</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Minden mezőt kötelező kitölteni az online fizetéshez!</div>
                </div>
                <div class="col-span-3">
                    <x-jet-label for="name" value="Név*"/>
                    <x-jet-input type="text" name="name" id="name" class="mt-1 block w-full" wire:model.defer="name"/>
                    <x-jet-input-error for="name" class="mt-1"/>
                </div>

                <div class="col-span-1">
                    <x-jet-label for="zip" value="Irányítószám*"/>
                    <x-jet-input type="text" name="zip" id="zip" class="mt-1 block w-full" wire:model.defer="zip" />
                    <x-jet-input-error for="zip" class="mt-1"/>
                </div>

                <div class="col-span-2">
                    <x-jet-label for="address" value="Teljes cím*"/>
                    <x-jet-input type="text" name="address" id="address" class="mt-1 block w-full" wire:model.defer="address" />
                    <x-jet-input-error for="address" class="mt-1"/>
                </div>

                <div class="col-span-3">
                    <x-jet-label for="tax_id" value="Adóazonosító*"/>
                    <x-jet-input type="text" name="tax_id" id="tax_id" class="mt-1 block w-full" wire:model.defer="tax_id" />
                    <x-jet-input-error for="tax_id" class="mt-1"/>
                </div>
                <div class="col-span-3 inline-flex">
                    <x-jet-button wire:click="store" wire:loading.attr="disabled">
                        Mentés
                    </x-jet-button>
                    <x-jet-action-message class="ml-3 mt-2" on="saved">
                        Sikeresen mentve.
                    </x-jet-action-message>
                </div>
            </div>
        </div>
        @else
            <div class="text-xl">Számla:</div>
            <div class="flex flex-row justify-center my-auto">
                <div class="flex flex-row">
                    <div>{{ $name }} - {{ $zip }} {{ $address }} - {{ $tax_id }}</div>
                    <a href="#" role="button" class="ml-4 inline text-blue-600 dark:text-blue-400 underline flex flex-row" wire:click="editAddress">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                        <div>Szerkesztés</div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
