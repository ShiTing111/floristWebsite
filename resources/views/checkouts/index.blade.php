@extends('layout')

@section('title', 'Checkout')

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
    height: 365px;
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
    <h2>DELIVERY METHOD</h2>
    <p class="lead">Free Shipping and Free Returns</p>

    <hr>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">SHIPPING ADDRESS</h4>

            {{-- success error msg start --}}
            @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif

            @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{-- success error msg end --}}

            <form method="POST" id="payment-form">
                @csrf
                <div class="mb-3">
                    <label for="billing_email">Email Address</label>
                    @if (auth()->user())
                    <input type="billing_email" class="form-control" id="billing_email" name="billing_email"
                        value="{{ auth()->user()->email }}" readonly>
                    @else
                    <input type="billing_email" class="form-control" id="billing_email" name="billing_email"
                        value="{{ old('email') }}">
                    @endif
                </div>


                <div class="mb-3">
                    <label for="billing_name">Name</label>
                    <input id="billing_name" type="text"
                        class="form-control @error('billing_name') is-invalid @enderror" name="billing_name"
                        value="{{ old('name') }}" autocomplete="name" autofocus>
                    @error('billing_name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="billing_address">Address</label>
                    <input id="billing_address" type="text"
                        class="form-control @error('billing_address') is-invalid @enderror" name="billing_address"
                        value="{{ old('address') }}" autocomplete="address" autofocus>
                    @error('billing_address')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="billing_city">City</label>
                        <input id="billing_city" type="text"
                            class="form-control @error('billing_city') is-invalid @enderror" name="billing_city"
                            value="{{ old('city') }}" autocomplete="city" autofocus>
                        @error('billing_city')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="billing_province">Province</label>
                        <input id="billing_province" type="text"
                            class="form-control @error('billing_province') is-invalid @enderror" name="billing_province"
                            value="{{ old('province') }}" autocomplete="province" autofocus>
                        @error('billing_province')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="billing_postalcode">Postal Code</label>
                        <input id="billing_postalcode" type="text"
                            class="form-control @error('billing_postalcode') is-invalid @enderror"
                            name="billing_postalcode" value="{{ old('postalcode') }}" autocomplete="postalcode"
                            autofocus>
                        @error('billing_postalcode')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div> <!-- row end -->

                <div class="mb-3">
                    <label for="billing_phone">Phone</label>
                    <input id="billing_phone" type="text"
                        class="form-control @error('billing_phone') is-invalid @enderror" name="billing_phone"
                        value="{{ old('phone') }}" autocomplete="phone" autofocus>
                    @error('billing_phone')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
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
                    <button type="submit" id="complete-order" class="spring-btn btn-lg btn-block">Checkout</button>
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
                            <td>{{Cart::count()}} BOUQUET</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Bouquet total</td>
                            <td>RM {{Cart::subtotal()}}</td>

                        </tr>

                        <tr>
                            <td>Tax(10%)</td>
                            <td>RM {{Cart::tax()}}</td>
                        </tr>
                        <tr>
                            <td>Delivery</td>
                            <td>FREE</td>
                        </tr>
                        <tr style="font-weight: bold">
                            <td>Total</td>
                            <td>RM {{Cart::total()}}</td>
                        </tr>
                    </table>
                </div>
            </div> {{-- cart_sidebar end --}}
            <br>
            <div class="ORDER DETAILS">
                <h4 style="font-weight: 550; font-size: 22px;">ORDER DETAILS</h4>
                <hr>
                @foreach (Cart::content() as $item)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="{{ asset('storage/bouquet/'.$item->model->image )}}" alt="item"
                                class="img_cartpage">
                        </div>
                        <div class="col-lg-7">
                            <a style="color: black;">{{$item->model->title}}</a>
                            <p>RM {{ $item->model->price }}</p>

                            <p class="cart_p">Quantity: {{ $item->qty }} </p>
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