<div class="p-5 pb-10 sm:px-10 bg-white border-b border-gray-200 dark:bg-gray-600 dark:border-gray-900">

    <div class="mt-8 text-2xl text-black dark:text-white">
        Üdvözöljük a szenior úszók versenyegendély kezelő rendszerében!
    </div>

    <div class="mt-6 text-gray-700 dark:text-gray-300">
        @if(auth()->user()->type == 'user')
            Kérjük várjon türelemmel míg egy adminisztrátorunk el nem fogadja a regisztrációját.
        @endif
    </div>

    <div class="mt-10">
        <div class="text-xl underline">Versenyengedély igénylés menete:</div>
        <div class="m-5">
            <ol class="list-decimal list-outside space-y-3">
                <li>Először is kattintson a <a href="{{ route('coach.forms.index') }}" class="text-blue-600 dark:text-blue-500 underline">Versenyengedély kérelmek</a> menüpontra.</li>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Új versenyengedélykérelem:</span></li>
                <ol class="list-decimal list-inside space-y-3">
                    <li>
                        Amennyiben új versenyengedély kérlemet szeretne létrehozni nyomjon rá az
                        <span class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Új versenyengedély kérelem</span>
                        gombra.
                    </li>
                    <li>Válassza ki a versenyzőt a legördülő listából. Ha a kiválaszott versenyzőnek van már mentett engedélye, akkor annak az adatait fogja betölteni.</li>
                    <li>
                        Töltse ki azokat az adatokat amiket tud, majd kattintson alul a
                        <span class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Mentés</span>
                        gombra. Menteni bármikor lehet!
                    </li>
                    <li>
                        Kérjük, hogy a fájlokat scannelt pdf vagy jól olvasható kép formátumba töltsék fel!
                    </li>
                    <li>
                        Ha megvan minden csillagal* jelölt adat és beszeretné küldeni a kérvényt, akkor kattintson az
                        <span class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Igénylés benyújtása</span>
                        gombra.
                    </li>
                    <li class="underline">Fontos, hogy egy mentett igénylést bármennyiszer lehet módosítani, viszont egy beküldött igénylést már egyáltalán nem lehet.</li>
                </ol>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Mentett versenyengedélykérelem szerkesztése:</span></li>
                <ol class="list-decimal list-inside space-y-3">
                    <li>Keresse ki a táblázatból azt a kérelmet amelyiket szerkeszteni szeretné. Használj a táblázat keresőjét vagy valamelyik táblázat szűrőt a sorok felett.</li>
                    <li>
                        Kattintson a táblázat végén lévő szerkesztés
                        <button class="p-1 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white rounded">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                        </button>
                        ikonra. Csak akkor lehet szerkeszteni a kérvényt amikor az állapota
                        <span class="inline-block rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>
                        van.
                    </li>
                    <li>Szerkessze a kivánt adatot, majd mentse el az űrlapot!</li>
                </ol>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Benyújtás után nincs más teendője mint várni 1-2 napot míg fel nem dolgozzuk.</span></li>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Ha elutasítottuk:</span></li>
                <ol class="list-decimal list-inside space-y-3">
                    <li>Amikor elutasítottuk a kérvényét a táblázatban az állapotnál <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutasítva</span> fog mejelenni.</li>
                    <li>Ilyenkor annyit tud tenni, hogy újra megpróbálja beküldeni a kérvényt.</li>
                </ol>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Ha sikeresen elfogadtuk:</span></li>
                <ol class="list-decimal list-inside space-y-3">
                    <li>Amikor elfogadtuk a kérvényét a táblázatban az állapotnál <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span> fog mejelenni.</li>
                    <li>
                        Kattintson a <span class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Fizetés</span>
                        gombra az Online fizetés megkezdéséhez.
                    </li>
                </ol>
                <li><span class="text-blue-600 dark:text-blue-500 font-bold">Online fizetés - Versenyengedélyek fizetése:</span></li>
                <ol class="list-decimal list-inside space-y-3">
                    <li>A számla adatait a rendszer automatikusan kitölti az Egyesülete alapján. Amennyiben hibát talál benne nyugodtan módosítsa.</li>
                    <li>Adja meg az Egyesület Adószámát majd kattintson a mentés gombra.</li>
                    <li>Baloldalt jelölje ki azokat a versenyengedélyeket amelyeket egybe szeretne fizetni. Jobb oldalt pedig automatikusan frissülni fog az összesen fizetendő összeg.</li>
                    <li>Kattintson a <span class="items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">Kosárba</span> gombra a kiválaszott engedélyek "kosárba" tételéhez.</li>
                    <li>A következő oldalon ha mindent rendben talál akkor kattintson az Online Fizetés gombra. Ez átfogja írányítani a <a href="https://stripe.com/en-hu" class="text-blue-600 dark:text-blue-500 underline">Stripe</a> fizetőkapu hivatalos oldalára.</li>
                    <li>Adja meg bankkártya adatait vagy használjon Google Pay/Apple Pay -t.</li>
                    <li>Sikeres fizetés után a rendszer vissza dobja a <a href="{{ route('coach.forms.index') }}" class="text-blue-600 dark:text-blue-500 underline">Versenyengedély kérelmek</a> oldalra ahol a fizetett engedély(ek)nél a státusz oszlopban <span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span> fog megjelenni.</li>
                    <li>Általában 1 percen belül a rendszer feldolgozza a fizetést és utána <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span> fog megjelenni.</li>
                    <li>A számláról automatikusan Emailt fog küldeni a rendszer de a <a href="{{ route('coach.payments') }}" class="text-blue-600 dark:text-blue-500 underline">Számlák</a> menüpontban is megtekintheti, illetve letöltheti őket.</li>
                    <li>Az elkészült versenyengedélyeket pedig a <a href="{{ route('coach.licences') }}" class="text-blue-600 dark:text-blue-500 underline">Versenyengedélyek</a> menüpontban találja majd.</li>
                </ol>
            </ol>
        </div>
    </div>
</div>
