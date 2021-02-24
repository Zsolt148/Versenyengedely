@component('mail::message')
@if($forms->count() > 1)
# Az alábbi versenyzők sportorvosi engedélyei lejártak:

@foreach($forms->get() as $form)
{{ $form->title }} {{ $form->vnev }} {{ $form->knev }}<br>
@endforeach

@else
# Az alábbi versenyző sportorvosi engedélye lejárt:
@foreach($forms->get() as $form)
{{ $form->title }} {{ $form->vnev }} {{ $form->knev }}<br>
@endforeach
@endif

@component('mail::button', ['url' => $url])
Versenyengedélyek megtekintése
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
