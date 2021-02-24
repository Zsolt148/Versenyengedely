<div>
    <x-jet-validation-errors class="mb-4" />

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

        <x-jet-label for="mandate" value="Bírósági végzés vagy Meghatalmazás (pdf, jpg, png)*" class="mt-2" />
        <input type="file" name="mandate" class="mt-1 block w-full" id="mandate" wire:model.defer="mandate">
    @endif

    <div class="mt-4">
        <x-jet-label for="name" value="Név*" />
        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autocomplete="name" wire:model.defer="name" />
    </div>

    <div class="mt-4">
        <x-jet-label for="email" value="Email cím*" />
        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" wire:model.defer="email" />
    </div>

    <div class="mt-4">
        <x-jet-label for="password" value="Jelszó*" />
        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" wire:model.defer="password" />
    </div>

    <div class="mt-4">
        <x-jet-label for="password_confirmation" value="Jelszó mégegyszer*" />
        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" wire:model.defer="password_confirmation" />
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-4">
            <x-jet-label for="terms">
                <div class="flex items-center">
                    <x-jet-checkbox name="terms" id="terms" wire:model.defer="terms" />

                    <div class="ml-2">
                        Elfogadom az <a href="{{ route('policy.show') }}" target="_blank" class="underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900">Adatvédelmi Irányelveket</a>
                    </div>
                </div>
            </x-jet-label>
        </div>
    @endif

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900" href="{{ route('login') }}">
            Bejelentkezés
        </a>

        <x-jet-button wire:loading.attr="disabled" wire:target="register, mandate" class="ml-4" wire:click.prevent="register">
            Regisztráció
        </x-jet-button>
    </div>
</div>
