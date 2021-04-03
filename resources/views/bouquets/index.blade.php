@extends('layouts.app')

@section('title', 'Bouquets')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

<style type="text/css">
.bouquet {
    font-size: 14px;
    margin-bottom: 10px
}

.bouquet_img {
    width: 255px;
}

.bouquet a {
    color: #000;
    text-decoration: none;
}

ul li a {
    list-style: none;
    color: #000;
}

ul li {
    list-style: none;
}

a:hover {
    color: black;
}

a {
    color: black;
}

.btn-light {
    color: black;
    background-color: white;
    border-color: whitesmoke;
    border-radius: 0;
}

.btn-light:hover {
    border-color: black;
    background-color: white;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: .5rem 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: black;
    text-align: left;
    list-style: none;
    background-color: white;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 0;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: .25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #000 !important;
    text-align: inherit;
    white-space: nowrap;
    background-color: white;
    border: 0;
}

.w-5 {
    display: none
}
</style>

<div class="container">
    @can('isAdmin')
    <div class="form-group row">
        <div class="col-md-12 text-right buttons">
            <a href="{{route('bouquets.create')}}">
                <button type="submit" class="spring-btn btn-lg">
                    Add Bouquet
                </button>
            </a>
        </div>
    </div>
    @endcan

    <div class="row">
        <div class="col-lg-7 mb-6">
            <h4 style="font-weight: bold">Bouquet</h4>
        </div>
        <div class="col-lg-5 mb-6">
            <!-- Example single danger button -->
            <div class="d-flex" style="margin-left: 70px;">
                <div class="dropdown mr-1">
                    <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuOffset"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        PRODUCT TYPE
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        @foreach ($bouquets as $category)
                        <a class="dropdown-item" style="color: #000;">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="btn-group" style="margin-right: 4px;">
                    <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuOffset3"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        PRICE
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset3">
                        <a class="dropdown-item">less than $50</a>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuOffset2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        SORT BY
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset2">
                        <a class="dropdown-item">
                            Newest</a>
                        <a class="dropdown-item" style="color: #000;">
                            Price :low - high</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        @forelse ($bouquets as $bouquet)
        <div class="col-xl-3">
            <div class="bouquet">
                <a href="{{ route('bouquets.show', $bouquet->id) }}">
                    <img class="bouquet_img" src="{{ asset('storage/bouquet/'.$bouquet->image )}}">
                </a>
                <br><br>
                <h5>{{ $bouquet->title }}</h5>
                <a>RM {{ $bouquet->price }}</a>
                <br>
                <!-- <p style="color: grey; font-size: 12px;">{{ $bouquet->size }}</p> -->
            </div> {{-- bouquet end --}}
            <br>
        </div>


        @empty
        @include('notfound');
        @endforelse

    </div> <!--  row end-->
</div>{{--  row end --}}
<div class="row justify-content-end">

    {{$bouquets->links()}}

</div>
</div> {{-- container end --}}


@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script>
@endsection