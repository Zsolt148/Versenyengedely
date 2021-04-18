<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Kezdőlap') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-5 pb-10 sm:px-10 bg-white border-b border-gray-200 dark:bg-gray-600 dark:border-gray-900">
                    <div class="mt-8 text-2xl">
                        Üdvözöljük a szenior úszók versenyengendély kezelő rendszerében!
                    </div>
                    @if(auth()->user()->type == 'user')
                        <div class="my-6 text-gray-700 dark:text-gray-300">
                            Kérjük várjon türelemmel míg egy adminisztrátorunk elfogadja a regisztrációját.
                        </div>
                    @endif
                    <table class="mt-6">
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="/docs/Versenyengedely_cikk_20210221.pdf" target="_blank" class="ml-1 underline">Általános Tájékozató</a></div></td>
                            <td><span class="ml-2 rounded-full bg-gray-300 text-gray-800 px-2 py-1 text-xs font-bold">pdf</span></td>
                        </tr>
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="/docs/Versenyengedelykero_lap_MSZUOSZ_2021.pdf" target="_blank" class="ml-1 underline">Versenyengedélykérő lap</a></div></td>
                            <td><span class="ml-2 rounded-full bg-gray-300 text-gray-800 px-2 py-1 text-xs font-bold">pdf</span></td>
                        </tr>
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="/docs/Versenyengedelykero_lap_MSZUOSZ_2021.docx" class="ml-1 underline">Versenyengedélykérő lap</a></div></td>
                            <td><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">docx</span></td>
                        </tr>
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="/docs/Versenyengedely_csapatvezetoi_meghatalmazas.docx"class="ml-1 underline">Meghatalmazás csapatvezetőnek</a></div></td>
                            <td><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">docx</span></td>
                        </tr>
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="https://www.youcompress.com/" target="_blank" class="ml-1 underline">Fájl tömörítő</a></div></td>
                            <td><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">link</span></td>
                        </tr>
                        <tr>
                            <td><div class="font-semibold text-blue-600 dark:text-blue-400"><a href="https://www.ilovepdf.com/merge_pdf" target="_blank" class="ml-1 underline">PDF egyesítő</a></div></td>
                            <td><span class="ml-2 rounded-full bg-blue-300 text-blue-800 px-2 py-1 text-xs font-bold">link</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <x-jet-section-border />

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-5 pb-10 sm:px-10 bg-white border-b border-gray-200 dark:bg-gray-600 dark:border-gray-900">
                    <div class="mt-8 text-2xl underline">Versenyengedély igénylés menete:</div>
                    <div class="m-5">
                        <ol class="list-decimal list-outside space-y-3">
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Kattintson a <a href="{{ route('coach.forms.index') }}" class="text-blue-600 dark:text-blue-400 underline">Versenyengedély kérelmek</a> menüpontra.</span></li>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Új versenyengedélykérelem benyújtása:</span></li>
                            <ol class="list-alpha list-inside space-y-3">
                                <li>
                                    Amennyiben új versenyengedély kérelmet szeretne létrehozni kattintson az
                                    <span class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Új versenyengedély kérelem</span>
                                    gombra.
                                </li>
                                <li>Válassza ki a versenyzőt a legördülő listából. Ha a kiválasztott versenyzőnek már van mentett engedélye, akkor annak az adatait fogja betölteni a rendszer. Ha nincs akkor üresen maradnak a mezők és a csapatvezetőnek kell a papír alapú kérelem alapján, az azon szereplő adatokat megadni.</li>
                                <li>
                                    Töltse ki azokat az adatokat (kötelező adatokat * jelzi), majd kattintson alul a
                                    <span class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Mentés</span>
                                    gombra (bal alsó gomb). <span class="underline">Menteni bármikor lehet az adatlap kitöltése közben is!</span>
                                </li>
                                <li>
                                    Kérjük, hogy a fájlokat scannelt PDF vagy jól olvasható kép formátumba töltsék fel! Amennyiben egy kép nem megfelelő, nem olvasható, akkor az engedély kérelem elutasításra kerül.
                                </li>
                                <li>
                                    Ha megvan minden csillaggal* jelölt adat és szeretné beküldeni a kérelmet, akkor kattintson az
                                    <span class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Igénylés benyújtása</span>
                                    gombra (jobb alsó gomb).
                                </li>
                                <li class="underline">Fontos, hogy egy mentett igénylést bármikor lehet módosítani, ellenben a beküldött igénylést már nem lehet módosítani.</li>
                                <li class="underline">Csak akkor kattintson az igénylés gombra, ha minden adat feltöltésre, beírásra került és azok helyességét ellenőrizte.</li>
                            </ol>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Mentett versenyengedély kérelemek szerkesztése:</span></li>
                            <ol class="list-alpha list-inside space-y-3">
                                <li>Keresse ki a táblázatból azt a kérelmet amelyiket módosítani, kiegészíteni (szerkeszteni) akar. Használj a táblázat keresőjét vagy valamelyik táblázat szűrőt a sorok felett.</li>
                                <li>
                                    Kattintson a táblázat végén lévő szerkesztés
                                    <button class="p-1 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white rounded">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                    </button>
                                    ikonra. Csak akkor lehet szerkeszteni egy kérvényt, ha az állapot oszlopban
                                    <span class="inline-block rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>,
                                    <span class="inline-block rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lejárt kérvény</span> vagy
                                    <span class="inline-block rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lejárt sportorvosi</span>
                                    felirat látható.
                                </li>
                                <li>Szerkessze a kívánt adatot, majd mentse el újra az űrlapot!</li>
                            </ol>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Benyújtás után nincs más teendő, meg kell várni a kérelem feldolgozását (adatok, jogviszony, orvosi ellenőrzése).</span></li>
                            <ol class="list-alpha list-inside space-py-3">
                                <li>A feldolgozottsági információkat az állapot oszlopban követheti.</li>
                            </ol>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Amennyiben elutasításra kerül egy kérelem:</span></li>
                            <ol class="list-alpha list-inside space-y-3">
                                <li>Amikor elutasításra kerül egy kérelem, akkor a kérelmek listában ez látható, mert az állapotnál <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutasítva</span> jelzet látható.</li>
                                <li>Az elutasításról e-mailt is kap a csapatvezető, amely tartalmazza az elutasítás okát.</li>
                                <li>Az adatok, csatolmányok javítása után a kérelem újra benyújtható a fent leírt módon.</li>
                            </ol>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Amennyiben elfogadásra (jóváhagyásra) kerül egy kérelem:</span></li>
                            <ol class="list-alpha list-inside space-y-3">
                                <li>Amikor elfogadásra kerül egy kérelem, akkor a kérelmek listában ez látható, mert az állapotnál <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span> jelzet látható.</li>
                                <li>Következő lépés a versenyengedély díjának befizetése</li>
                                <li>
                                    Kattintson a <span class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Fizetés</span>
                                    gombra az Online fizetés megkezdéséhez.
                                </li>
                            </ol>
                            <li><span class="text-blue-600 dark:text-blue-400 font-bold">Online fizetés - Versenyengedély díj befizetése:</span></li>
                            <ol class="list-alpha list-inside space-y-3">
                                <li>A versenyengedély díját kizárólag elektronikus úton bankkártyával az online rendszeren keresztül lehet megtenni. Más fizetési módot nem fogad el a Szövetség.</li>
                                <li>A számla adatait a rendszer automatikusan kitölti az az igénylő Egyesület adatai alapján. Kérjük ezt mindenképpen ellenőrizze előzetesen. Amennyiben hibát talál kérjük javítsa.</li>
                                <li>Adja meg az Egyesület Adószámát majd kattintson a mentés gombra.</li>
                                <li>Baloldalt jelölje ki azokat a versenyengedélyeket, amelyeket egyszerre egy banki tranzakció keretében akar fizetni.</li>
                                <li>Kattintson a <span class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Kosárba</span> gombra a kiválasztott engedélyek "kosárba" helyezéséhez.</li>
                                <li>A következő oldalon ellenőrizze az adatokat, összeget.</li>
                                <li>Amennyiben megfelelnek az adatok, kattintson az Online Fizetés gombra. </li>
                                <li>Az online fizetés a <a href="https://stripe.com/en-hu" class="text-blue-600 dark:text-blue-400 underline">Stripe</a> fizetőkapu hivatalos oldalára irányítja. <span class="underline">Fontos: ne zárja be a böngésző ablakot.</span></li>
                                <li>Adja meg bankkártya adatait vagy használjon Google Pay/Apple Pay alkalmazást.</li>
                                <li>Sikeres fizetés után a rendszer visszairányítja a <a href="{{ route('coach.forms.index') }}" class="text-blue-600 dark:text-blue-400 underline">Versenyengedély kérelmek</a> oldalra, ahol a Fizetés oszlopban az engedély(ek)nél <span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span> szöveg jelenik meg.</li>
                                <li>Rövid időn belül a rendszer feldolgozza a fizetést és utána <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span> jelzet fog ebben az oszlopban megjelenni.</li>
                                <li>A fizetésről a rendszer egy automatikus e-mailt fog küldeni, amely tartalmazza a befizetési bizonylatot.</li>
                                <li>A fizetési bizonylat a rendszerben is elérhető a <a href="{{ route('coach.payments') }}" class="text-blue-600 dark:text-blue-400 underline">Bizonylatok</a> menüpontban, innen is letölthetők.</li>
                                <li>Az elkészült versenyengedélyeket a <a href="{{ route('coach.licences') }}" class="text-blue-600 dark:text-blue-400 underline">Versenyengedélyek</a> menüpontban találja.</li>
                                <li>A versenyengedélyek PDF formában letölthetők, de a rendszerben bármikor lekérdezhetők is.</li>
                                <li>A versenyengedélyek érvényességi ideje 1 év.</li>
                            </ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
