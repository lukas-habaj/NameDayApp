@extends('layouts.app')

@section('title', 'Home')

@section('main')
    <section class="main">
        <div>
            @if($todaysNamesWithCount['todaysNamesCount'] > 0)
                <div>Dnes je <span>{{ $dayOfWeekName }}</span>, {{ date('j.n.Y') }}.</div>
                <div>Kto má dnes meniny?</div>
                <div>{{ $todaysNamesWithCount['todaysNames'] }}</div>
            @else
                Dnes nie je v kalendári žiadne meno.
            @endif
        </div>

    </section>
@endsection
