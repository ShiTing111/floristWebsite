<?php

use Carbon\Carbon;

?>

@extends('layout')

@section('title', 'My Orders')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')



<style type="text/css">
a {
    color: black;

}

a:hover {
    color: black;
}

ul li {
    list-style: none;
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

    @can('isAdmin')
    <h2>Customers Orders</h2>
    @endcan

    @can('isUser')
    <h2>My Orders</h2>
    @endcan

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col"> Order Placed </th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->billing_name}}</td>
                        <td>{{ Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                        <td>RM {{ $order->billing_total }}</td>
                        <td><a href="{{ route('orders.show', $order) }}">Order Details</a></td>
                        <td>
                            <div class="ORDER DETAILS">
                                <h4 style="font-weight: 600; font-size: 22px;">ORDER DETAILS</h4>
                                @foreach ($order->bouquets as $bouquet)
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <img src="{{ asset('storage/bouquet/'.$bouquet->image )}}" alt="item"
                                                class="img_cartpage">
                                        </div>
                                        <div class="col-lg-7">
                                            <a href="{{ route('bouquets.show', $bouquet->id) }}"
                                                style="color: black;">{{ $bouquet->title }}</a>

                                            <p>RM {{ $bouquet->price }}</p>

                                            <p class="cart_p">Quantity: {{ $bouquet->pivot->quantity }} </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div> {{-- ORDER DETAILS end --}}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>




</div>


@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script>
@endsection