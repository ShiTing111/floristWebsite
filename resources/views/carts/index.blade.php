@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
<link rel="stylesheet" href="{{ asset('css/laravel-ecommerce.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
@endsection

@section('content')

<style type="text/css">
form {
    float: left;
    margin-top: 0em;
}

.btn-link {
    color: black;
    text-decoration: underline;

}

.btn-link:hover {
    color: black;
    text-decoration: underline;

}

/*text-transform: uppercase;*/
</style>
<br>

<div class="container">

    {{-- ----------------------------- ROW CART START ----------------------------- --}}
    <div class="row">
        <div class="col-lg-9 col-sm-6 col-xs-12">
            <a href="/" style="color: black;">Home</a>
            /
            <span>Shopping Cart</span>


            @if(Cart::count() > 0)
            <h2>YOUR BAG <span class="title_cartpage">{{Cart::count()}} ITEMS </span></h2>


            {{-- success error msg start --}}
            @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{session()->get('success_message')}}
            </div>
            @endif

            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{-- success error msg end --}}
            <hr>

            <br>
            @foreach(Cart::content() as $item)
            <div class="container cart_item">
                <div class="row">
                    <div class="col-lg-2">
                        <a>
                        <img src="{{ asset('storage/bouquet/'.$item->model->image )}}" class="img_cartpage"></a>
                    </div>

                    <div class="col-lg-5">
                        <a class="cart_a"> {{$item->model->title}}</a>
                        <p class="cart_p">Category: {{$item->model->category}} <br>
                            <b>In Stock</b> <i class="far fa fa-check"></i>
                        </p>
                        <p>

                        <form action="{{route('carts.destroy',$item->rowId)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link">Delete</button>
                        </form>

                        <form action="{{route('carts.switchToSaveForLater',$item->rowId)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link">SaveForLater</button>
                        </form>
                        </p>

                    </div> {{-- col-lg-5 end --}}

                    <div class="flex-w">
                        <div class="flex-m">
                            <div class="flex-w bo5 of-hidden m-t-10 m-b-10">
                                <button type="submit" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input class="size8 m-text18 t-center num-product" data-id="{{ $item->rowId }}"
                                    data-productQuantity="{{ $item->model->quantity }}" type="number" name="quantity"
                                    value="{{$item->qty}}" />
                                <button type="submit" class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                    <div class="col-lg-2">$ {{$item->subtotal}}</div>
                </div>
            </div>
            <hr>
            @endforeach

            <div class="row">
                <div class="col-md-10">
                    <a href="{{route('bouquets.index')}}" style="margin-right: 8px">Continue Shopping</a>
                </div>
                <div class="col-md-2">
                    <p>Subtotal : {{Cart::subtotal()}}</p>
                    <p>Tax(10%) : {{Cart::tax()}}</p>
                    <p><b>Total: {{Cart::total()}} </b></p>
                </div>
            </div>
            @else
            <h3>No items in Cart!</h3>
            <a href="{{ route('bouquets.index') }}" class="btn btn-link">Continue Shopping</a>

            @endif

        </div> {{-- col-lg-9 col-sm-6 col-xs-12 end --}}
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="cart_sidebar">
                <br>
                <a href="{{route('checkouts.index')}}" class="btn btn-dark btn-lg btn-block"
                    style=" margin-right: :4px;">Checkout <i class="fa fa-arrow-right"
                        style="margin-left: 35px;"></i></a>
                <p class="text-center" style="padding: 7px;">By placing your order, you agree to <br>the Delivery Terms
                </p>
                <h4 style="font-weight: 600; font-size: 22px; margin-left: 9px;">ORDER SUMMARY:</h4>
                <div class="cart-calculator">
                    <table class="table">
                        <tr>
                            <td>{{Cart::count()}} PRODUCTS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Product total</td>
                            <td>${{Cart::subtotal()}}</td>

                        </tr>
                        <tr>
                            <td>Tax(13%)</td>
                            <td>${{Cart::tax()}}</td>
                        </tr>
                        <tr>
                            <td>Delivery</td>
                            <td>FREE</td>
                        </tr>
                        <tr style="font-weight: bold">
                            <td>Total</td>
                            <td>${{Cart::total()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cart_needhelp">
                <h4>NEED HELP?</h4>
                <p><a href="" style="color: #000;">Shipping</a></p>
                <p><a href="" style="color: #000;">Returns & Exchanges</a></p>
                <p><a href="" style="color: #000;">Contact Us</a></p>
            </div>
        </div> {{-- col-lg-3 col-sm-6 col-xs-12 end --}}
    </div>{{--  row end --}}

    {{-- ----------------------------- ROW CART END ----------------------------- --}}



</div> {{-- col-lg-9 end --}}
<div class="col-lg-3">

</div>
</div> {{-- row end --}}


</div>
<br><br>

@endsection

@section('extra-js')
<script type="text/javascript" src="{{ asset('jquery/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('js/app.js') }}"></script>
<script>
(function() {
    // https://stackoverflow.com/questions/44074952/increment-and-decrement-price-value-on-change
    $('[name=quantity]').change(function() {
        const id = $(this).attr("data-id")
        const productQuantity = $(this).attr('data-productQuantity')

        axios.patch(`/carts/${id}`, {
                quantity: this.value,
                productQuantity: productQuantity
            })
            .then(function(response) {
                // console.log(response);
                window.location.href = '{{ route('carts.index') }}'
            })
            .catch(function(error) {
                // console.log(error);
                window.location.href = '{{ route('carts.index') }}'
            });
    });
})();
</script>
@endsection