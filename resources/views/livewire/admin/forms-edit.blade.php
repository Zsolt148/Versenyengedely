<div>
    <a href="{{ route('admin.forms.index') }}" role="button" class="mb-2 items-center px-4 py-2 bg-gray-200 border border rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-300 active:bg-gray-500 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Vissza</a>
    @if($form)
        <div class="text-gray-800 dark:text-white mt-5 mb-2 underline">Kiválasztott sportoló:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-5">
                <x-jet-label for="">Név</x-jet-label>
                {{ $form->competitor->name }}
            </div>
            <div class="mx-2 sm:mx-5">
                <x-jet-label for="">Születési év</x-jet-label>
                {{ $form->competitor->birth }}
            </div>
            <div class="mx-2 sm:mx-5">
                <x-jet-label for="">Egyesületi kód</x-jet-label>
                {{ $form->competitor->team_reg_code }}
            </div>
            <div class="mx-2 sm:mx-5">
                <x-jet-label for="">Szövetségi kód</x-jet-label>
                {{ $form->competitor->federal_reg_code }}
            </div>
        </div>
        <hr class="my-5">
        <div class="text-gray-800 dark:text-white mb-2 underline">Személyes adatok:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Megadott teljes neve" />
                {{ $form->title }} {{ $form->vnev }} {{ $form->knev }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Születési ideje" />
                {{ $form->birth->format('Y.m.d') }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Születési helye" />
                {{ $form->birth_place }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Anyja neve" />
                {{ $form->mother }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Nem" />
                @if($form->sex == "male") Férfi @else Nő @endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Adatkezelési tájékoztató" />
                @if($form->privacy_policy == true) Elfogadva @else Elutasítva @endif
            </div>
        </div>
        <div class="flex flex-row flex-wrap mt-5">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Irányítószám" />
                {{ $form->zip }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Város" />
                {{ $form->city }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Lakcím" />
                {{ $form->address }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Email" />
                {{ $form->email }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Telefon" />
                {{ $form->mobile }}
            </div>
        </div>
        <hr class="my-5">
        <div class="text-gray-800 dark:text-white mb-2 underline">Szövetségi adatok:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Egyesület" />
                {{ $form->team->name }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Szövetségi regisztrációs kód" />
                {{ $form->federal_reg_code }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Egyesületi regisztrációs kód" />
                {{ $form->team_reg_code }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Típus" />
                @if($form->comp_type == "senior") Szenior úszó @else Amatőr @endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Év" />
                {{ $form->year }}
            </div>
        </div>
        <hr class="my-5">
        <div class="text-gray-800 dark:text-white mb-2 underline">Sportorvosi vizsgálat:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Sportorvosi időpontja" />
                {{ $form->sport_time->format('Y.m.d') }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Sportorvosi eredménye" />
                @if($form->can_race) <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Versenyezhet</span> @else <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nem versenyezhet</span> @endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Sportorvosi érvényessége" />
                {{ $form->sport_valid->format('Y.m.d') }}
            </div>
        </div>
        <hr class="my-5">
        <div class="text-gray-800 dark:text-white mb-2 underline">Feltött fájlok:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Feltöltött Profilkép" />
                <a href="/file/{{ $form->profile_photo }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Profilkép</a>
                @if(stripos($form->profile_photo, ".pdf") === false)<img src="/file/{{ $form->profile_photo }}" class="rounded-lg shadow-lg mt-2" alt="Profilkép" width="100" height="200">@endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Feltöltött Adatlap" />
                <a href="/file/{{ $form->data_sheet }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Adatlap</a>
                @if(stripos($form->data_sheet, ".pdf") === false)<img src="/file/{{ $form->data_sheet }}" class="rounded-lg shadow-lg mt-2" alt="Adatlap" width="100" height="200">@endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Feltöltött Sportorvosi igazolás" />
                <a href="/file/{{ $form->sport_sheet }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Sportorvosi</a>
                @if(stripos($form->sport_sheet, ".pdf") === false)<img src="/file/{{ $form->sport_sheet }}" class="rounded-lg shadow-lg mt-2" alt="Sportorvosi" width="100" height="200">@endif
            </div>
        </div>
        <hr class="my-5">
        <div class="text-gray-800 dark:text-white mb-2 underline">Info:</div>
        <div class="flex flex-row flex-wrap">
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Állapot" />
                @if($form->status == "pending")
                    <span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Feldolgozás alatt</span>
                @elseif($form->status == "accepted")
                    <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span>
                @elseif($form->status == "denied")
                    <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutasítva</span>
                @elseif($form->status == "saved")
                    <span class="inline-block rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>
                @endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Fizetés állapota" />
                @if($form->payment == "pending")
                    <span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span>
                @elseif($form->payment == "done")
                    <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span>
                @elseif($form->payment == "none")
                    <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nincs</span>
                @endif
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Kérelmezte" />
                {{ $form->user->name }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Benyújtotta:" />
                {{ $form->turn_in->format('Y.m.d H:i:s') }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Utoljára szerkesztve:" />
                {{ $form->updated_at->format('Y.m.d H:i:s') }}
            </div>
            <div class="mr-5 sm:mr-10">
                <x-jet-label for="" value="Létrehozta:" />
                {{ $form->created_at->format('Y.m.d H:i:s') }}
            </div>
        </div>
        <div class="mt-20" x-data="{ open: @entangle('showDeny').defer }">
            <div class="flex flex-row">
                <button type="submit" wire:click.prevent="submit('accept')" wire:loading.attr="disabled" class="items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    Elfogadás
                </button>
                <button @click="open = true" class="ml-2 items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    Elutasítás
                </button>
                <x-jet-action-message class="ml-3 mt-2" on="saved">
                    Sikeresen Mentve.
                </x-jet-action-message>
            </div>
            @if($form->processedBy && $form->processed)
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-200">Feldolgozta: {{ $form->processedBy->name }} - {{ $form->processed->format('Y.m.d H:i:s') }}</div>
            @endif
            <div x-show="open" class="mt-3">
                <x-jet-label for="deny" value="Elutasítás indoka*" />
                <textarea name="deny" id="deny" class="mt-1 block w-full form-input rounded-md shadow-sm dark:bg-gray-700" rows="3" wire:model.defer="deny">{{ $form->deny }}</textarea>
                <x-jet-danger-button class="mt-3" wire:click="submit('deny')" wire:loading.attr="disabled">
                    Mentés
                </x-jet-danger-button>
            </div>
        </div>
    @else
        <div class="mt-5">
            Nincs több feldolgozandó versenyengedély kérelem.
        </div>
    @endif

</div>
