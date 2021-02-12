<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            Elutasított versenyengedély kérelem
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-600">
                <div class="mt-3 text-2xl">
                    VERSENYENGEDÉLY-KÉRŐ LAP - Elutasítva
                </div>
                <div class="mb-6 mt-5">
                    <div class="underline">Elutasítás indoka:</div>
                    {{ $form->deny }}
                </div>
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-6">
                        <div class="sm:col-span-12">
                            <x-jet-label for="team" value="Egyesület" />
                            <div id="team">{{ $form->team->name }}</div>
                        </div>

                        <div class="sm:col-span-12">
                            <x-jet-label for="competitors_id" value="Versenyző*"/>
                            <select class="mt-1 block w-full rounded-md shadow-md border-2 dark:bg-gray-700 focus:outline-none" name="competitors_id" id="group" disabled>
                                <option value="{{ $form->competitor->id }}" selected>{{ $form->competitor->name }} - {{ $form->competitor->birth }} - {{ $form->competitor->federal_reg_code }}</option>
                            </select>
                            <x-jet-input-error for="form.competitors_id" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-12">
                            <hr>
                        </div>

                        <div class="sm:col-span-2">
                            <x-jet-label for="title" value="Titulus"/>
                            <x-jet-input id="title" type="text" class="mt-1 block w-full" value="{{ $form->title }}" disabled/>
                            <x-jet-input-error for="form.title" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-5">
                            <x-jet-label for="vnev" value="Vezetéknév*"/>
                            <x-jet-input id="vnev" type="text" class="mt-1 block w-full" value="{{ $form->vnev }}" disabled/>
                            <x-jet-input-error for="form.vnev" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-5">
                            <x-jet-label for="knev" value="Keresztnév*"/>
                            <x-jet-input id="knev" type="text" class="mt-1 block w-full" value="{{ $form->knev }}" disabled/>
                            <x-jet-input-error for="form.knev" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-jet-label for="sex" value="Neme*" class="mb-1"/>
                            <input type="radio" id="male" value="male" name="sex" disabled @if($form->sex == 'male') checked @endif>
                            <label for="male">Férfi</label>
                            <input type="radio" class="ml-5" id="female" value="female" name="sex" disabled @if($form->sex == 'female') checked @endif>
                            <label for="female">Nő</label>
                            <x-jet-input-error for="form.sex" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-jet-label for="mother" value="Anyja neve*"/>
                            <x-jet-input id="mother" type="text" class="mt-1 block w-full" value="{{ $form->mother }}" disabled/>
                            <x-jet-input-error for="form.mother" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-jet-label for="birth" value="Születési ideje*"/>
                            <x-jet-input id="birth" type="date" class="mt-1 block w-full" value="{{ $form->birth->format('Y-m-d') }}" disabled/>
                            <x-jet-input-error for="form.birth" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-jet-label for="birth_place" value="Születési helye*"/>
                            <x-jet-input id="birth_place" type="text" class="mt-1 block w-full" value="{{ $form->birth_place }}" disabled/>
                            <x-jet-input-error for="form.birth_place" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-12">
                            <hr>
                        </div>

                        <div class="sm:col-span-2">
                            <x-jet-label for="zip" value="Irányítószám*"/>
                            <x-jet-input id="zip" type="number" class="mt-1 block w-full" value="{{ $form->zip }}" disabled/>
                            <x-jet-input-error for="form.zip" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-4">
                            <x-jet-label for="city" value="Város*"/>
                            <x-jet-input id="city" type="text" class="mt-1 block w-full" value="{{ $form->city }}" disabled/>
                            <x-jet-input-error for="form.city" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="address" value="Levelezési Cím*"/>
                            <x-jet-input id="address" type="text" class="mt-1 block w-full" value="{{ $form->address }}" disabled/>
                            <x-jet-input-error for="form.address" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="mobile" value="Mobiltelefon száma*"/>
                            <x-jet-input id="mobile" type="text" class="mt-1 block w-full" value="{{ $form->mobile }}" disabled/>
                            <x-jet-input-error for="form.mobile" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="email" value="Email címe*"/>
                            <x-jet-input id="email" type="text" class="mt-1 block w-full" value="{{ $form->email }}" disabled/>
                            <x-jet-input-error for="form.email" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-12">
                            <hr>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="federal_reg_code" value="Szövetségi regisztrációs szám*"/>
                            <x-jet-input id="federal_reg_code" type="text" class="mt-1 block w-full" value="{{ $form->federal_reg_code }}" disabled/>
                            <x-jet-input-error for="form.federal_reg_code" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="team_reg_code" value="Egyesületi regisztrációs szám"/>
                            <x-jet-input id="team_reg_code" type="text" class="mt-1 block w-full" value="{{ $form->team_reg_code }}" disabled/>
                            <x-jet-input-error for="form.team_reg_code" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="profile_photo" value="Profilkép (pdf, jpg, png)*"/>
                            <input type="file" name="profile_photo" class="mt-1 block w-full" disabled>
                            <x-jet-input-error for="profile_photo" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6 flex flex-row">
                            @if($data = $form->profile_photo ?? null)
                                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Feltöltött Profilkép:</a>
                                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-10" alt="Profilkép" width="100" height="200">@endif
                                @endif
                            @endif
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="data_sheet" value="Adatlap (pdf, jpg, png)*"/>
                            <input type="file" name="data_sheet" class="mt-1 block w-full" disabled>
                            <x-jet-input-error for="data_sheet" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6 flex flex-row">
                            @if($data = $form->data_sheet ?? null)
                                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Feltöltött Adatlap:</a>
                                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-11" alt="Adatlap" width="100" height="200">@endif
                                @endif
                            @endif
                        </div>

                        <div class="sm:col-span-12">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="privacy_policy" id="privacy_policy" disabled checked/>

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
                            <x-jet-input id="sport_time" type="date" class="mt-1 block w-full" value="{{ $form->sport_time->format('Y-m-d') }}" disabled/>
                            <x-jet-input-error for="form.sport_time" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-4">
                            <x-jet-label for="can_race" value="Sportorvosi eredménye" class="mb-1"/>
                            <input type="radio" id="canrace" value="1" name="can_race" disabled @if($form->can_race == 1) checked @endif>
                            <label for="canrace">Versenyezhet</label>
                            <input type="radio" class="ml-5" id="cantrace" value="0" name="can_race" disabled @if($form->can_race == 0) checked @endif>
                            <label for="cantrace">Nem versenyezhet</label>
                            <x-jet-input-error for="form.can_race" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-4">
                            <x-jet-label for="sport_valid" value="Sportorvosi érvényessége*"/>
                            <x-jet-input id="sport_valid" type="date" class="mt-1 block w-full" value="{{ $form->sport_valid->format('Y-m-d') }}" disabled />
                            <x-jet-input-error for="form.sport_valid" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-jet-label for="sport_sheet" value="Sportorvosi Igazolás (pdf, jpg, png)*"/>
                            <input type="file" name="sport_sheet" class="mt-1 block w-full" disabled>
                            <x-jet-input-error for="sport_sheet" class="mt-2"/>
                        </div>

                        <div class="sm:col-span-6 flex flex-row mb-10">
                            @if($data = $form->sport_sheet ?? null)
                                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($data))
                                    <a href="/file/{{$data}}" target="_blank" class="text-blue-600 dark:text-blue-400 underline mt-1">Feltöltött Sportorvosi:</a>
                                    @if(stripos($data, ".pdf") === false)<img src="/file/{{$data}}" class="rounded-lg shadow-lg ml-5 sm:ml-5" alt="Sportorvosi" width="100" height="200">@endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
