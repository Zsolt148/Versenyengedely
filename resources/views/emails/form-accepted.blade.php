@component('mail::message')
# Versenyengedély kérelem elfogadva

A {{ $form->title }} {{ $form->vnev }} {{ $form->knev }} versenyengedély kérelmét sikeresen elfogadtuk.

@component('mail::button', ['url' => $url])
Versenyengedélykérelmek
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
