@component('mail::message')
# Versenyengedély kérelem elutasítva

Sajnálattal közöljük, hogy a {{ $form->title }} {{ $form->vnev }} {{ $form->knev }} versenyengedély kérelme elutasítva lett az alábbi indokkal:

<p>{{ $form->deny }}</p>

@component('mail::button', ['url' => $url])
Versenyengedély kérelmek
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
