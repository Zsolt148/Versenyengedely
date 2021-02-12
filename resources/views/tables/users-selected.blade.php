<div path="UserTable::$selected" language="javascript" class="my-4 flex items-start">
    <input type="hidden" name="selected[]" wire:model.defer="selected">
    <div class="inline-flex mt-2">Kijelöltekkel művelet:</div>
    <select class="mt-1 block w-1/4 rounded-md shadow-md border text-sm inline-flex ml-4 dark:bg-gray-700 focus:outline-none" name="action" id="action" wire:model.defer="action" wire:change="changeAction">
        <option value="">Válassz</option>
        <option value="changeType">Jogosultság szerkesztése</option>
        <option value="acceptType">Regisztráció elfogadása és jogosultság megadása</option>
    </select>
    @if($changeType)
        <select class="mt-1 block w-1/4 rounded-md shadow-md border text-sm inline-flex ml-4 dark:bg-gray-700 focus:outline-none" name="type" id="type" wire:model.defer="type">
            <option value="">Válassz</option>
            @foreach(\App\Models\User::TYPES as $key => $a)
                <option value="{{$key}}">{{$a}}</option>
            @endforeach
        </select>
    @endif
    @if($changeType || $acceptType)
        <div class="mt-1 inline-flex ml-4">
            <button type="submit" wire:click.prevent="updateSelected()" wire:loading.attr="disabled" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Mentés
            </button>
            <x-jet-action-message class="ml-3 mt-2" on="saved">
                {{ __('Mentve.') }}
            </x-jet-action-message>
        </div>
    @endif
</div>
