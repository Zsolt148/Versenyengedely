<div>
    <div class="grid grid-cols-1 sm:grid-cols-12 gap-6">
        <div class="sm:col-span-12">
            <x-jet-label for="team" value="Egyesület" />
            <div id="team">{{ Auth::user()->team->name }}</div>
        </div>

        <div class="sm:col-span-12">
            <x-jet-label for="competitors_id" value="Versenyző*"/>
            <select class="mt-1 block w-full rounded-md shadow-md border-2 dark:bg-gray-700 focus:outline-none" name="competitors_id" id="group" wire:model.defer="form.competitors_id" wire:change="changedComp">
                <option value="">Válassz</option>
                @foreach(Auth::user()->competitors as $c)
                    <option value="{{ $c->id }}">{{ $c->name }} - {{ $c->birth }} - {{ $c->federal_reg_code }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="form.competitors_id" class="mt-2"/>
        </div>

        <!--
        <div class="sm:col-span-6">
            <x-jet-label for="comp_type" value="A sportág neve/versenyző státusza*" class="mb-1"/>
            <input type="radio" id="senior" value="senior" name="comp_type" wire:model.defer="form.comp_type">
            <label for="senior">Szenior úszás</label>
            <input type="radio" class="ml-5" id="amateur" value="amateur" name="comp_type" wire:model.defer="form.comp_type">
            <label for="amateur">Amatőr</label>
            <x-jet-input-error for="form.comp_type" class="mt-2"/>
        </div>
        -->

        <div class="sm:col-span-12">
            <hr>
        </div>

        <div class="sm:col-span-2">
            <x-jet-label for="title" value="Titulus"/>
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="form.title" placeholder="Dr."/>
            <x-jet-input-error for="form.title" class="mt-2"/>
        </div>

        <div class="sm:col-span-5">
            <x-jet-label for="vnev" value="Vezetéknév*"/>
            <x-jet-input id="vnev" type="text" class="mt-1 block w-full" wire:model.defer="form.vnev"/>
            <x-jet-input-error for="form.vnev" class="mt-2"/>
        </div>

        <div class="sm:col-span-5">
            <x-jet-label for="knev" value="Keresztnév*"/>
            <x-jet-input id="knev" type="text" class="mt-1 block w-full" wire:model.defer="form.knev"/>
            <x-jet-input-error for="form.knev" class="mt-2"/>
        </div>

        <div class="sm:col-span-3">
            <x-jet-label for="sex" value="Neme*" class="mb-1"/>
            <input type="radio" id="male" value="male" name="sex" wire:model.defer="form.sex">
            <label for="male">Férfi</label>
            <input type="radio" class="ml-5" id="female" value="female" name="sex" wire:model.defer="form.sex">
            <label for="female">Nő</label>
            <x-jet-input-error for="form.sex" class="mt-2"/>
        </div>

        <div class="sm:col-span-3">
            <x-jet-label for="mother" value="Anyja neve*"/>
            <x-jet-input id="mother" type="text" class="mt-1 block w-full" wire:model.defer="form.mother"/>
            <x-jet-input-error for="form.mother" class="mt-2"/>
        </div>

        <div class="sm:col-span-3">
            <x-jet-label for="birth" value="Születési dátuma*"/>
            <x-jet-input id="birth" type="date" class="mt-1 block w-full" wire:model.defer="form.birth"/>
            <x-jet-input-error for="form.birth" class="mt-2"/>
        </div>

        <div class="sm:col-span-3">
            <x-jet-label for="birth_place" value="Születési helye*"/>
            <x-jet-input id="birth_place" type="text" class="mt-1 block w-full" wire:model.defer="form.birth_place"/>
            <x-jet-input-error for="form.birth_place" class="mt-2"/>
        </div>

        <div class="sm:col-span-12">
            <hr>
        </div>

        <div class="sm:col-span-2">
            <x-jet-label for="zip" value="Irányítószám*"/>
            <x-jet-input id="zip" type="number" class="mt-1 block w-full" wire:model.defer="form.zip"/>
            <x-jet-input-error for="form.zip" class="mt-2"/>
        </div>

        <div class="sm:col-span-4">
            <x-jet-label for="city" value="Város*"/>
            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="form.city"/>
            <x-jet-input-error for="form.city" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="address" value="Levelezési Cím*"/>
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="form.address"/>
            <x-jet-input-error for="form.address" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="mobile" value="Mobiltelefon száma*"/>
            <x-jet-input id="mobile" type="text" class="mt-1 block w-full" wire:model.defer="form.mobile" placeholder="0630.."/>
            <x-jet-input-error for="form.mobile" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="email" value="Email címe*"/>
            <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="form.email" placeholder="példa@gmail.com"/>
            <x-jet-input-error for="form.email" class="mt-2"/>
        </div>

        <div class="sm:col-span-12">
            <hr>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="federal_reg_code" value="Szövetségi regisztrációs szám*"/>
            <x-jet-input id="federal_reg_code" type="text" class="mt-1 block w-full" wire:model.defer="form.federal_reg_code" placeholder="31/1234"/>
            <x-jet-input-error for="form.federal_reg_code" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="team_reg_code" value="Egyesületi regisztrációs szám"/>
            <x-jet-input id="team_reg_code" type="text" class="mt-1 block w-full" wire:model.defer="form.team_reg_code" placeholder="31001"/>
            <x-jet-input-error for="form.team_reg_code" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="profile_photo" value="Profilkép (pdf, jpg, png)*"/>
            <input type="file" name="profile_photo" class="mt-1 block w-full" id="upload1{{ $iteration }}" wire:model.defer="profile_photo">
            <x-jet-input-error for="profile_photo" class="mt-2"/>
        </div>

        <div class="sm:col-span-6 flex flex-row">
            @if($data = $form['profile_photo'] ?? null)
                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Feltöltött Profilkép:</a>
                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-10" alt="Profilkép" width="100" height="200">@endif
                @endif
            @endif
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="data_sheet" value="Adatlap (pdf, jpg, png)*"/>
            <input type="file" name="data_sheet" class="mt-1 block w-full" id="upload2{{ $iteration }}" wire:model.defer="data_sheet">
            <x-jet-input-error for="data_sheet" class="mt-2"/>
        </div>

        <div class="sm:col-span-6 flex flex-row">
            @if($data = $form['data_sheet'] ?? null)
                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Feltöltött Adatlap:</a>
                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-11" alt="Adatlap" width="100" height="200">@endif
                @endif
            @endif
        </div>

        <div class="sm:col-span-12">
            <x-jet-label for="terms">
                <div class="flex items-center">
                    <x-jet-checkbox name="privacy_policy" id="privacy_policy" wire:model.defer="form.privacy_policy"/>

                    <div class="ml-2">
                        Hozzájárulok, hogy az MSZÚOSZ a www.mszuosz.hu oldalon elérhető Adatkezelési Tájékoztató(k) szerint a rólam készült kép-, illetve hangfelvételt a szenior úszás sportág népszerűsítése érdekében történő nyilvános kommunikáció, különösen a sporteseményekről készített kisfilmek, reklámfilmek, plakátok formájában kezelje.
                    </div>
                </div>
            </x-jet-label>
            <x-jet-input-error for="form.privacy_policy" class="mt-2"/>
        </div>

        <div class="sm:col-span-12">
            <hr>
        </div>

        <div class="sm:col-span-4">
            <x-jet-label for="sport_time" value="Sportorvosi időpontja*"/>
            <x-jet-input id="sport_time" type="date" class="mt-1 block w-full" wire:model.defer="form.sport_time"/>
            <x-jet-input-error for="form.sport_time" class="mt-2"/>
        </div>

        <div class="sm:col-span-4">
            <x-jet-label for="can_race" value="Sportorvosi eredménye" class="mb-1"/>
            <input type="radio" id="canrace" value="1" name="can_race" wire:model.defer="form.can_race">
            <label for="canrace">Versenyezhet</label>
            <input type="radio" class="ml-5" id="cantrace" value="0" name="can_race" wire:model.defer="form.can_race">
            <label for="cantrace">Nem versenyezhet</label>
            <x-jet-input-error for="form.can_race" class="mt-2"/>
        </div>

        <div class="sm:col-span-4">
            <x-jet-label for="sport_valid" value="Sportorvosi érvényessége*"/>
            <x-jet-input id="sport_valid" type="date" class="mt-1 block w-full" wire:model.defer="form.sport_valid"/>
            <x-jet-input-error for="form.sport_valid" class="mt-2"/>
        </div>

        <div class="sm:col-span-6">
            <x-jet-label for="sport_sheet" value="Sportorvosi Igazolás (pdf, jpg, png)*"/>
            <input type="file" name="sport_sheet" class="mt-1 block w-full" id="upload3{{ $iteration }}" wire:model.defer="sport_sheet">
            <x-jet-input-error for="sport_sheet" class="mt-2"/>
        </div>

        <div class="sm:col-span-6 flex flex-row">
            @if($data = $form['sport_sheet'] ?? null)
                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline mt-1">Feltöltött Sportorvosi:</a>
                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-5" alt="Sportorvosi" width="100" height="200">@endif
                @endif
            @endif
        </div>

        <div class="sm:col-span-12 mt-10 flex flex-row flex-wrap justify-between">
            <div class="inline-flex order-1">
                <x-jet-button wire:loading.attr="disabled" wire:target="final, save, profile_photo, data_sheet, sport_sheet" wire:click="save">
                    Mentés
                </x-jet-button>
                <x-jet-action-message class="ml-3 mt-2" on="saved">
                    {{ __('Sikeresen Mentve.') }}
                </x-jet-action-message>
                <!--<div wire:loading class="text-gray-600 dark:text-gray-400 ml-3 mt-2">Töltés..</div>-->
            </div>
            <div wire:loading class="w-30 order-last sm:order-2 mt-1">
                <div class="text-lg items-center flex w-full">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-800 dark:text-white"> Töltés...</span>
                </div>
            </div>
            <x-jet-danger-button wire:loading.attr="disabled" wire:target="final, save, profile_photo, data_sheet, sport_sheet" wire:click="final" class="order-3">
                Igénylés benyújtása
            </x-jet-danger-button>
        </div>

    </div>
</div>
