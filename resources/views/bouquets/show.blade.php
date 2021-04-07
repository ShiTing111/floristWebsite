@extends('layout')

@section('title', $bouquet->title)

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('animsition/css/animsition.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('select2/select2.min.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"> -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

@endsection

@section('content')

<style type="text/css">
.zms_price {
    font-size: 16px;
    font-weight: 400;
}

.badge-success {
    color: #fff;
    background-color: black !important;
}

.slick3-dots .slick-active {
    border-bottom: 2px solid black;
}

.bouquet_img {
    width: 400px;
}
</style>
<div class="container">
    @if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif

    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div> {{-- container end --}}

<!-- Bouquet Detail -->

<div class="animsition">
    <div class="container bgwhite p-t-35 p-b-80">

        <a href="/">Home</a>
        /
        <span><a href="{{ route('bouquets.index') }}">Shop</a></span>
        /
        <span>{{ $bouquet->title }}</span>


        <div class="row">
            <div class="col-xl-6">
                <div class="col-xl-6">
                    <img class="bouquet_img p-t-105" src="{{ asset('storage/bouquet/'.$bouquet->image )}}"
                        alt="IMG-PRODUCT">
                </div>
            </div>


            <div class="col-xl-6">
                <h4 class="product-detail-name">
                    {{ $bouquet->title }}
                </h4>

                <span class="zms_price">
                    RM {{ $bouquet->price }}
                </span>@
                @can('isAdmin')
                <span class="zms_price">
                    Quantity: {{ $bouquet->quantity }}
                </span>
                @endcan
                <p>{!! $stockLevel !!} </p>
                
                <div class="p-b-20">
                    <span class="s-text8">Category: {{ $bouquet->category->name }}</span>
                </div>
                @cannot('isAdmin')
                <!-- Add to Cart -->
                <form action="{{ route('carts.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="p-t-33 p-b-60">

                        <div class="flex-w">
                            <div class="flex-m">
                                <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                    <input type="hidden" name="productQuantity" value="{{$bouquet->quantity}}">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                    <input class="size8 m-text18 t-center num-product" type="number" name="quantity"
                                        value="1">
                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="flex-w p-t-10">
                            <input type="hidden" value="{{$bouquet->id}}" name="id">
                            <div class="w-size16 flex-m flex-w buttons">
                                @csrf
                                <button type="submit" class="spring-btn btn-lg">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                @endcannot
                <!-- Description -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Description
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            {{ $bouquet->description }}
                        </p>
                    </div>
                </div>
                <br><br>
                @can('isAdmin')
                <div class="row justify-content-end">
                    <div class="col-xl-3">
                        <a class="form-inline justify-content-end" href="{{ route('bouquets.edit', $bouquet->id) }}">
                            <button class="btn btn-success btn-lg">
                                Update
                            </button>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <form class="form-inline justify-content-end" method="POST"
                            action="{{ route('bouquets.destroy',$bouquet->id) }}"
                            onSubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endcan
            </div>

        </div>
    </div>
</div>
{{--   --------------------- Bouquet detail end ----------- --}}
@endsection

@section('extra-js')
<script>
</script>
<script type="text/javascript" src="{{ asset('jquery/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>
@endsection