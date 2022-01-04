<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            {{ __('Versenyengedélyek fizetése') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 dark:bg-gray-600 mt-10">
                <div class="flex flex-row flex-wrap justify-center my-auto">
                    <div class="">
                        <h2 class="text-xl">Kiválasztott versenyengedélyek:</h2>
                        @php($total = 0)
                        @foreach($forms as $form)
                            @if($form->payments->isEmpty())
                                @php($total += 3000)
                            @else
                                @php($total += 1500)
                            @endif
                            <div class="flex items-center mb-2">
                                <div class="mb-1">
                                    {{ $form->title }} {{ $form->vnev }} {{ $form->knev }} {!! \App\Models\Form::STATUS[$form->status] !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sm:ml-20">
                        <h1 class="text-2xl">Összesen fizetendő: {{ number_format($total, 0, '', ' ') }} Ft</h1>
                        <span class="text-gray-600 dark:text-gray-200 text-sm">3000 Ft versenyengedélyenként</span><br>
                        <div class="mt-4">
                            <button id="checkout-button" class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                                Online fizetés
                            </button>
                        </div>
                        <span class="mt-4 text-gray-600 dark:text-gray-200 text-sm">Google és Apple pay-re is van lehetőség.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
            var checkoutButton = document.getElementById("checkout-button");

            var stripe = Stripe("{{ env('STRIPE_KEY') }}");

            checkoutButton.addEventListener('click', function () {
                stripe.redirectToCheckout({
                    sessionId: '{{ $session->id }}'
                }).then(function (result) {
                    console.log(result)
                }).catch(function (error) {
                    console.error("Error:", error);
                });
            });
        </script>
    @endpush
</x-app-layout>
