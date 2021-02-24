<div>
    <div class="my-5 text-sm text-gray-600 dark:text-gray-400">
        Csapatvezető típusú felhasználóknak kötelező az egyesület kiválasztása.
    </div>

    <livewire:users-table searchable="" sort="" exportable />

    <div class="my-20"></div>


    <x-jet-dialog-modal maxWidth="2xl" wire:model="isOpen">
        <x-slot name="title">
            Felhasználó szerkesztése
        </x-slot>

        <x-slot name="content">
            <input type="hidden" id="id" name="id" wire:model.defer="idd">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6">
                    <x-jet-label for="name" value="{{ __('Név') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-6 ">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"/>
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

                <div class="col-span-6">
                    <x-jet-label for="type" value="{{ __('Típus') }}" />
                    <select class="mt-1 block w-full rounded-md shadow-md border dark:bg-gray-700 focus:outline-none" name="type" id="type" wire:model.defer="type">
                        @foreach(\App\Models\User::TYPES as $key => $g)
                            <option value="{{ $key }}" @if($key == $type) selected @endif>{{ $g }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="type" class="mt-2" />
                </div>

                <div class="col-span-6">
                    <x-jet-label for="team" value="{{ __('Egyesület') }}" />
                    <select class="mt-1 block w-full rounded-md shadow-md border dark:bg-gray-700 focus:outline-none" name="team" id="team" wire:model.defer="team">
                        <option value="">Üres</option>
                        @foreach(\App\Models\Team::all() as $t)
                            <option value="{{ $t->id }}" @if($t->id == $team) selected @endif>{{ $t->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="team" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('isOpen')" wire:loading.attr="disabled">
                Mégse
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="save()" wire:loading.attr="disabled">
                Mentés
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Felhasználó törlése
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">Biztosan törölni szeretnéd a felhasználót ?</div>
            @if($deleteUserId)
                @php $user = App\Models\User::find($deleteUserId); @endphp
                <div class="mb-4">
                    <span class="text-blue-500">{{ $user->name }}</span> - <span class="text-blue-500">{{ $user->email }}</span>
                </div>
                <div class="mb-4">
                    A felhasználó törlése esetén a rendszer archiválni fogja a kérvényeit és a bizonylatait.
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Mégse
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Törlése
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
