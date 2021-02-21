@extends('layouts.app')

@section('title', 'Home')

@section('main')
    <div class="container">
        <div class="row">
            <div class="info-box-wrapper">
                <div class="info-box">
                    @if($todaysNamesWithCount['todaysNamesCount'] > 0)
                        <div>Dnes je {{ $dayOfWeekName }}, <b>{{ date('j.n.Y') }}</b>.</div>
                        <div>Kto má dnes meniny?</div>
                        <div><b>{{ $todaysNamesWithCount['todaysNames'] }}</b></div>
                    @else
                        <div>Dnes nie je v kalendári žiadne meno.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
