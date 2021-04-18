<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 dark:bg-gray-600">
        <a href="{{ route('admin.forms.index') }}" role="button" class="mb-2 items-center px-4 py-2 bg-gray-200 border border rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-300 active:bg-gray-500 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Vissza</a>
        @if($form)
            <div class="text-gray-800 dark:text-white mt-5 mb-2 underline">Kiválasztott sportoló:</div>
            <div class="flex flex-row flex-wrap">
                <div class="mr-5 sm:mr-5">
                    <x-jet-label for="">Név</x-jet-label>
                    <div class="text-xl">{{ $form->competitor->name }}</div>
                </div>
                <div class="mx-2 sm:mx-5">
                    <x-jet-label for="">Születési év</x-jet-label>
                    <div class="text-xl">{{ $form->competitor->birth }}</div>
                </div>
                <div class="mx-2 sm:mx-5">
                    <x-jet-label for="">Egyesületi kód</x-jet-label>
                    <div class="text-xl">{{ $form->competitor->team_reg_code }}</div>
                </div>
                <div class="mx-2 sm:mx-5">
                    <x-jet-label for="">Szövetségi kód</x-jet-label>
                    <div class="text-xl">{{ $form->competitor->federal_reg_code }}</div>
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
                    @php echo htmlspecialchars_decode(\App\Models\Form::STATUS[$form->status]) @endphp
                </div>
                <div class="mr-5 sm:mr-10">
                    <x-jet-label for="" value="Fizetés állapota" />
                    @php echo htmlspecialchars_decode(\App\Models\Form::PAYMENT[$form->payment]) @endphp
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
            <div class="mt-5" x-data="{ open: @entangle('showDeny').defer }">
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
    <div class="container">
        <div class="flex flex-col mx-auto p-2 text-gray-700 dark:text-gray-300">
            @if($logs)
                @foreach($logs as $log)
                    @foreach($log->changes['attributes'] as $key => $value)
                        @if($value && in_array($key, ['sport_sheet', 'license', 'status', 'payment']))
                            <!-- right -->
                            <div class="flex">
                                <div class="col-start-5 col-end-6 mr-10 relative">
                                    <div class="h-full w-6 flex items-center justify-center">
                                        <div class="h-full w-1 bg-gray-300 dark:bg-gray-500 pointer-events-none"></div>
                                    </div>
                                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full {{ \App\Models\Form::COLORS[$log->description] }} shadow"></div>
                                </div>
                                <div class="{{ \App\Models\Form::COLORS[$log->description] }} col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                                    <h3 class="font-bold text-lg mb-1">
                                        {{ $log->created_at->format('Y.m.d H:i:s') }} - @php echo htmlspecialchars_decode(\App\Models\Form::LOG_LABEL[$log->description]) @endphp
                                    </h3>
                                    <p class="leading-tight text-justify">
                                        @switch($key)
                                            @case('sport_sheet')
                                            <a href="/file/{{$value}}" target="_blank" class="underline">Sportorvosi</a>
                                            @break
                                            @case('license')
                                            <a href="/license/{{$value}}" target="_blank" class="underline">Kiállított Engedély</a>
                                            @break
                                            @case('status')
                                            <span class="font-bold">{{ \App\Models\Form::LOGS[$key] }}</span>: @if($log->changes['old'][$key] ?? null) @php echo htmlspecialchars_decode(\App\Models\Form::STATUS[$log->changes['old'][$key]]) @endphp -> @endif @php echo htmlspecialchars_decode(\App\Models\Form::STATUS[$value]) @endphp
                                            <br>
                                            @break
                                            @case('payment')
                                            <span class="font-bold">{{ \App\Models\Form::LOGS[$key] }}</span>: @if($log->changes['old'][$key] ?? null) @php echo htmlspecialchars_decode(\App\Models\Form::PAYMENT[$log->changes['old'][$key]]) @endphp -> @endif @php echo htmlspecialchars_decode(\App\Models\Form::PAYMENT[$value]) @endphp
                                            <br>
                                            @break
                                            @default
                                            <span class="font-bold">{{ \App\Models\Form::LOGS[$key] }}</span>: {{ ($log->changes['old'][$key] ?? null) ? $log->changes['old'][$key] . ' ->' : null }} {{ $value }} <br>
                                            @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
</div>
