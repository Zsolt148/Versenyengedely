<div>
    <div class="my-5">
        <x-jet-button wire:click="$toggle('openNew')" wire:loading.attr="disabled">
            Egyesület hozzáadása
        </x-jet-button>
    </div>
    <livewire:admin.teams-table />
    <x-jet-dialog-modal maxWidth="2xl" wire:model="openNew">
        <x-slot name="title">
            Új egyesület felvétele
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                    <x-jet-label for="name" value="{{ __('Név') }}"/>
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"/>
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>

                <div class="col-span-6">
                    <x-jet-label for="sa" value="{{ __('SA') }}"/>
                    <x-jet-input id="sa" type="text" class="mt-1 block w-full" wire:model.defer="sa"/>
                    <x-jet-input-error for="sa" class="mt-2"/>
                </div>

                <div class="col-span-6">
                    <x-jet-label for="address" value="{{ __('Cím') }}"/>
                    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address"/>
                    <x-jet-input-error for="address" class="mt-2"/>
                </div>

                <div class="col-span-6">
                    <x-jet-label for="webpage" value="{{ __('Honlap') }}"/>
                    <x-jet-input id="webpage" type="text" class="mt-1 block w-full" wire:model.defer="webpage"/>
                    <x-jet-input-error for="webpage" class="mt-2"/>
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openNew')" wire:loading.attr="disabled">
                {{ __('Mégse') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
                {{ __('Létrehozás') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
