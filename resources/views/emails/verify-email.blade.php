@component('mail::message')
# Üdv!

<p>
Kérlek kattints az alábbi gombra az Email címed megerősítéséhez.
</p>

@component('mail::button', ['url' => $url])
Email megerősítése
@endcomponent

<p>
Ha nem te hoztad létre a fiókot, akkor nincs további teendőd.
</p>

<br>

Üdvözlettel,<br>
{{ config('app.name') }}

@slot('subcopy')
@lang(
"Ha nem sikerül az \"Email megerősítése\" gombra kattintani, másold be a linket\n".
'a böngésződ címsorába:',
) <span class="break-all"><a href="{{ $url }}">{{ $url }}</a></span>
@endslot
@endcomponent
