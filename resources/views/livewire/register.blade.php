<div>
    <x-jet-label for="type" value="Regisztrálás mint*: " />
    <select name="type" id="type" class="block mt-1 w-full rounded-md shadow-md border-2 dark:bg-gray-700 focus:outline-none" wire:model.defer="type" wire:change="typeChanged">
        <option value="">Válassz</option>
        <option value="organizer">Versenyrendező</option>
        <option value="coach">Csapatvezető</option>
        <option value="admin">MSZUOSZ adminisztrátor</option>
    </select>
    @if($coach)
        <x-jet-label for="teams_id" value="Egyesület*" class="mt-2" />
        <select name="teams_id" id="teams_id" class="block mt-1 w-full rounded-md shadow-md border-2 dark:bg-gray-700 focus:outline-none" wire:model.defer="teams_id">
            <option value="">Válassz</option>
            @foreach(\App\Models\Team::all() as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
        </select>
    @endif
</div>
