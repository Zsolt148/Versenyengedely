@component('mail::message')
# Sikertelen fizetés

Sajnálattal közöljük, hogy a fizetés közben váratlan hiba lépett fel.
<br>

@component('mail::button', ['url' => $url])
Fizetés újrapróbálása
@endcomponent

Üdvözlettel,<br>
{{ config('app.name') }}
@endcomponent
