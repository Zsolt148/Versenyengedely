@component('mail::message')
@if($forms->count() > 1)
# Az alábbi versenyzők versenyengedélyei lejártak:

@foreach($forms->get() as $form)
{{ $form->title }} {{ $form->vnev }} {{ $form->knev }} - {{ $form->form_valid->format('Y.m.d') }} <br>
@endforeach

@else
# Az alábbi versenyző versenyengedélye lejárt:
@foreach($forms->get() as $form)
{{ $form->title }} {{ $form->vnev }} {{ $form->knev }} - {{ $form->form_valid->format('Y.m.d') }} <br>
@endforeach
@endif

@component('mail::button', ['url' => $url])
Versenyengedélyek megtekintése
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
