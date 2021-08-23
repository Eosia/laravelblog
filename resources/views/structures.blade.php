


{{--@isset($fruits)
    {{ count($fruits) }}
@endif--}}

{{--@php
    phpinfo()
@endphp--}}

{{--@forelse($fruits as $fruit)
    <p>{{ $fruit }}</p>
@empty
    aucun fruit
@endforelse--}}

{{--@foreach($fruits as $fruit)
    <p>{{ $fruit }}</p>
@endforeach--}}

{{--
@unless($number == 5)
    Nombre différent de 5
@endunless
--}}

{{--@for($i = 0; $i <= 5; $i++)
    <p>Nombre égal à {{ $i }}</p>
@endfor--}}

{{--
@if($number < 5 )
    Inférieur à 5
@elseif($number == 5)
    Egale à 5
@else
    Supérieur à 5
@endif
--}}
