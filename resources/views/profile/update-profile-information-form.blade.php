<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profil adatok') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Frissítheted az adataidat.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="vnev" value="{{ __('Név') }}" />
            <x-jet-input id="vnev" type="text" class="mt-1 block w-full" wire:model.defer="state.name" />
            <x-jet-input-error for="vnev" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full disabled:opacity-50" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Mentve.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Mentés') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
