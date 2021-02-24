<div class="flex space-x-1 justify-around">
    @php $status = \App\Models\Form::find($id)->status; @endphp
    <button wire:click="editForm({{$id}})" class="p-1 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white rounded disabled:opacity-50" @if($status == "pending" || $status == "accepted") disabled @endif>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
    </button>
</div>
