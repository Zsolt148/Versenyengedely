<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-600 mt-10">
        <div class="flex flex-row flex-wrap justify-center my-auto">
            <div class="">
                <h2 class="text-xl">Fizetésre váró versenyengedélyek:</h2>
                <div class="text-gray-600 dark:text-gray-200 text-sm mb-5">Válaszd ki azokat az engedélyeket amelyeket egybe ki szeretnél fizetni.</div>
                @foreach($forms as $form)
                    <div class="flex items-center mb-2">
                        <x-jet-checkbox name="selectedForms[]" id="{{ $form->id }}" wire:model.defer="selectedForms.{{ $form->id }}" wire:click="formClicked"/>

                        <div class="ml-2">
                            {{ $form->title }} {{ $form->vnev }} {{ $form->knev }} <span class="ml-2 inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="sm:ml-20">
                <h1 class="text-2xl">Összesen: {{ $total }} Ft</h1>
                <span class="text-gray-600 dark:text-gray-200 text-sm">1000 Ft versenyengedélyenként</span><br>
                <div class="mt-4">
                    <form action="{{ route('coach.forms.checkout') }}" class="inline-flex" method="post">
                        @csrf
                        @foreach($selectedForms as $key => $form)
                            <input type="hidden" name="selected[]" id="selected_{{ $key }}" value="{{ $key }}">
                        @endforeach
                        <button wire:loading.attr="disabled" @if($disabled) disabled @endif id="cart-button" class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                            Kosárba
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
