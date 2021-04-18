@component('mail::message')
# Új felhasználó:

<p>
{{ $user->name }} <br>
{{ $user->email }} <br>
{{ \App\Models\User::TYPES[$user->wannabe] ?? '-'}}
</p>

@component('mail::button', ['url' => $url])
Felhasználók
@endcomponent

Üdv,<br>
{{ config('app.name') }}
@endcomponent
