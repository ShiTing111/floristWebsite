@extends('layout')

@section('title', 'Unauthorized')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

<div class="container">
    <div class="row" style="height: 500px;">
        <div class="col-lg-4"></div>
        <div class="col-lg-5">
                <h1>You are <b style="color: red">Unauthorized</b> to view this page!</h1>
        </div>
    </div>  
</div>
@endsection
