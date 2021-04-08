@extends('layout')

@section('title', 'Edit Order')

@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>
<link rel="stylesheet" href="{{ asset('css/ecom.css') }}">
@endsection

@section('content')

<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

.StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}

.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}

html,
body {
    font-family: 'Lato', sans-serif;
    font-family: 'Open Sans', sans-serif;
    font-family: 'Abel', sans-serif;
}

.cart_sidebar {
    height: 150px;
    width: 300px;
    background-color: #f8f9fa;
}

a {
    color: black;
}

a:hover {
    color: black;
}
</style>

<div class="container">

    <br><br>
    <h2>UPDATE ORDER DETAILS</h2>
    <p class="lead">Delivery Method: Free Shipping and Free Returns</p>

    <hr>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">SHIPPING ADDRESS</h4>

            {{-- success error msg start --}}
            @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success" role="alert">
                {{ session()->get('success_message') }}
            </div>
            @endif

            <form action="{{ route('orders.update',$order->id) }}" method="POST" id="payment-form">

                <div class="mb-3">
                    <label for="email">Email Address</label>
                    @if (auth()->user())
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
                        readonly>
                    @else
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="billing_name"
                        value="{{$order->billing_name}}" required>
                </div>


                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="billing_address"
                        value="{{$order->billing_address}}" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="billing_city"
                            value="{{$order->billing_city}}" required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="billing_province"
                            value="{{$order->billing_province}}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" class="form-control" id="postalcode" name="billing_postalcode"
                            value="{{$order->billing_postalcode}}" required>
                    </div>
                </div> <!-- row end -->

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="billing_phone"
                        value="{{$order->billing_phone}}" required>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                <div class="row">
                    <div class="col-md-12">
                        <label for="card-element">
                            Cash on Delivery
                        </label>
                        <div id="card-element">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="buttons">
                    @csrf
                    @method('PUT')
                    <button type="submit" id="complete-order" class="spring-btn btn-lg btn-block">Update</button>
                </div>
            </form>
        </div>{{--  col-md-8 order-md-1 end --}}
        <div class="col-md-4 order-md-2 mb-4">
            <div class="cart_sidebar">
                <br>
                <h4 style="font-weight: 600; font-size: 22px; margin-left: 9px;">ORDER SUMMARY:</h4>
                <div class="cart-calculator">
                    <table class="table">
                        <tr>
                            <td>{{$count}} BOUQUET</td>
                            <td></td>
                        </tr>

                        <tr style="font-weight: bold">
                            <td>Total</td>
                            <td>RM {{$order->billing_total}}</td>
                        </tr>
                    </table>
                </div>
            </div> {{-- cart_sidebar end --}}
            <br>
            <div class="ORDER DETAILS">
                <h4 style="font-weight: 550; font-size: 22px;">ORDER DETAILS</h4>
                <hr>
                @foreach ($order->bouquets as $bouquet)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="{{ asset('storage/bouquet/'.$bouquet->image )}}" alt="item" class="img_cartpage">
                        </div>
                        <div class="col-lg-7">
                            <a style="color: black;">{{$bouquet->title}}</a>
                            <p>RM {{ $bouquet->price }}</p>

                            <p class="cart_p">Quantity: {{ $bouquet->pivot->quantity }} </p>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div> 
</div>

<br><br>
@endsection

@section('extra-js')
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
@endsection