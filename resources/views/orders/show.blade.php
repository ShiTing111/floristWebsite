<?php

use Carbon\Carbon;

?>

@extends('layout')

@section('title', 'My Order')

@section('extra-css')
@endsection

@section('content')
<style type="text/css">
ul li {
    list-style: none;
}

a {
    color: black;
}

a:hover {
    color: black;
}

.profile_sa {
    background-color: transparent;
    color: #000;
    cursor: pointer;

    padding-left: 1px;
    padding-right: 1px;
    text-decoration: underline;
    transition: color .1s cubic-bezier(.3, 0, .45, 1), background-color .1s cubic-bezier(.3, 0, .45, 1);
    margin-top: 10px;

}
</style>

<div class="container">

    <a href="/">Home</a>
    /
    @can('isAdmin')
    <span>Orders</span>
    @endcan

    @can('isUser')
    <span>My Orders</span>
    @endcan

    <h2>ORDER DETAIL INFORMATION</h2>

    <div class="row">

        <div class="col-lg-9">
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

            <p>Order Placed : {{ Carbon::parse($order->created_at)->format('M d, Y') }}</p>
            <p>Order ID : {{ $order->id }}</p>
            <p>TOTAL : RM {{ $order->billing_total }}</p>

            <table class="table" style="width:50%">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $order->billing_address }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $order->billing_city }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>RM {{ $order->billing_total }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Status</td>
                        <td>{{ $order->delivery_status }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Date</td>
                        @if($order->delivery_date != null)
                        <td>{{ $order->delivery_date }}</td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                  </tbody>
            </table>
            @can('isUser')
            @if($order->delivery_status == "Pending")
            <div class="row">
                <div class="col-xl-1">
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-dark pull-right">Update</a>
                    <t>
                </div>
                <div class="col-xl-2">
                    <form class="form-inline" method="POST" action="{{ route('orders.destroy',$order) }}"
                        onSubmit="return confirm('Are you sure you want to cancel order?');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">
                            Cancel Order
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @endcan

            @can('isAdmin')
            @if($order->delivery_status == "Pending")
            <div class="row">
                <div class="col-xl-6">
                    <form class="form-inline" method="POST" action="{{ route('orders.update', $order->id) }}"
                        onSubmit="return confirm('Are you sure you want to mark as delivered for this order?');">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="delivery_date" value="{{ Carbon::now()->toDateTimeString() }}">
                        <input type="hidden" name="delivery_status" value={{ 'delivered' }}>
                        <button type="submit" class="btn btn-success">
                            Mark as Delivered
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @endcan
            <br><br>

            @if(count($bouquets) > 0)
            <h4 style="font-weight: 600; font-size: 22px;">ORDER DETAILS</h4>
            @foreach ($bouquets as $bouquet)
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <img src="{{ asset('storage/bouquet/'.$bouquet->image )}}" alt="item" class="img_cartpage">
                    </div>
                    <div class="col-lg-7">
                        <a href="{{ route('bouquets.show', $bouquet->id) }}"
                            style="color: black; font-size: 18px; font-weight: 600">{{ $bouquet->title }}</a>

                        <p>RM {{ $bouquet->price }}</p>

                        <p class="cart_p">COLOR: Black <br>
                            Quantity: {{ $bouquet->pivot->quantity }} </p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div> {{-- col-lg-9 end --}}

        <div class="col-lg-3">
            <h5>My Profile</h5>
            <p><a href="{{ route('users.index') }}" class="profile_sa">
                    Personal Information</a></p>
            <p><a href="{{ route('orders.index') }}" class="profile_sa">Order History</a></p>
        </div>
    </div>
</div>

<div style="height: 190px;"></div>


@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script>
@endsection
