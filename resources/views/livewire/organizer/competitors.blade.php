<div>
    <div class="flex flex-row flex-wrap space-x-0 sm:space-x-2">
        <div class="w-full sm:w-1/3 mt-5">
            <div class="w-full inline-block relative">
                <input type="text" name="search" wire:model="search"
                       class="border border-gray-300 dark:border-white block w-full appearance-none bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-5 pl-8 rounded-md shadow-md focus:outline-none"
                       placeholder="Keresés"/>
                <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-700 dark:text-gray-200">
                    <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
                        <path d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="ml-0 mt-5 md:ml-5 w-full sm:w-1/5">
            <select class="block w-full rounded-md shadow-md border border-gray-300 dark:bg-gray-700 focus:outline-none" name="year" id="year" wire:model="year">
                @foreach(\App\Models\Form::YEARS as $key => $year)
                    <option value="{{ $key }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="overflow-x-auto mt-6">
        <table class="table-auto border-collapse w-full">
            <thead>
                <tr class="font-medium text-gray-700 dark:text-white text-left">
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-tl-2xl">#ID</th>
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700">MSZÚOSZ Igazolási szám</th>
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700">Versenyző neve</th>
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700">Sz.év</th>
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700">Egyesület</th>
                    <th class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-tr-2xl">Sportorvosi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-normal text-gray-700">
                @forelse($result as $value)
                    <tr class="@if($loop->odd) bg-white dark:bg-gray-600 @else bg-gray-50 dark:bg-gray-700 @endif hover:bg-gray-100 dark:hover:bg-gray-500 border-b border-gray-400 py-10">
                        <td class="px-4 py-2 dark:text-white">{{ $value->id }}</td>
                        <td class="px-4 py-2 dark:text-white">{{ $value->federal_reg_code }}</td>
                        <td class="px-4 py-2 dark:text-white">{{ $value->title }} {{ $value->vnev }} {{ $value->knev }}</td>
                        <td class="px-4 py-2 dark:text-white">{{ $value->birth->format('Y') }}</td>
                        <td class="px-4 py-2 dark:text-white">{{ $value->team->name }}</td>
                        <td class="px-4 py-2 dark:text-white">
                            @if($value->can_race) <span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Versenyezhet</span> @else <span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nem versenyezhet</span> @endif
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-600 border-b border-gray-400 py-10">
                        <td colspan="6" class="px-4 py-5 dark:text-white text-lg">Nincs találat a következőre: '{{ $search }}' - {{ $year }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
