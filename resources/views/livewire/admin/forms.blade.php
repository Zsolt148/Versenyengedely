<div>
    <div class="my-5">
        <a role="button" href="{{ route('admin.forms.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
            Kérelmek feldolgozása
        </a>
    </div>

    <livewire:admin.forms-table />

</div>
