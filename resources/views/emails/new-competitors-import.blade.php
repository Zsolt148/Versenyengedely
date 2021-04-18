@component('mail::message')
# Sportoló importálás eredménye:

@if($missing)
<p>Hiányzó Sportolók:
<ol>
@forelse($missing as $comp)
<li>
{{ $comp['name'] }} - {{ $comp['federal_reg_code'] }} - {{ $comp['birth'] }} - {{ $comp['team'] }}
</li>
@empty
-
@endforelse
</ol>
</p>
@endif

@if($young)
<p>25 év alatti sportolók:
<ol>
@forelse($young as $comp)
<li>
{{ $comp['name'] }} - {{ $comp['federal_reg_code'] }} - {{ $comp['birth'] }} - {{ $comp['team'] }}
</li>
@empty
-
@endforelse
</ol>
</p>
@endif


Üdv,<br>
{{ config('app.name') }}
@endcomponent
