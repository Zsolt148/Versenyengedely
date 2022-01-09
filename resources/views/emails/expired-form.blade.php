@component('mail::message')
@if($forms->count() > 1)
# Az alábbi versenyzők versenyengedélyei lejártak:
@else
# Az alábbi versenyző versenyengedélye lejárt:
@endif

@foreach($forms->get() as $form)
{{ $form->title }} {{ $form->vnev }} {{ $form->knev }} - {{ $form->birth->format('Y.m.d') }} <br>
@endforeach

@component('mail::button', ['url' => $url])
Versenyengedélyek megtekintése
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
