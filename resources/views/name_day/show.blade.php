@extends('layouts.app')

@section('title', 'Name')

@section('main')
    <div class="container">
        <div class="row">
            <div class="info-box-wrapper">
                <div class="info-box">
                    <div><b>{{ $nameData->name }}</b> má meniny</div>
                    <div><b>{{ $nameData->date }}</b></div>
                </div>
            </div>
        </div>
    </div>
@endsection
