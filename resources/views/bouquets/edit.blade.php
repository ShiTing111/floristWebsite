<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <br>
                <h2 style="text-align: center"> Edit New Bouquet </h2>
                <br>
                <div class="card-body">
                    <form action="{{ route('bouquets.update',$bouquet->id) }}" method="POST" class="admin_form word" enctype="multipart/form-data" onSubmit="return confirm('Are you sure you wish to update the bouquet detail?');">
                    <!-- Title -->
                    @method('PUT')
                    @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$bouquet->title}}" required autocomplete="title" autofocus>
                            @error('title')
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$bouquet->description}}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$bouquet->price}}" required autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group row">
                            <label for="category"
                                class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category" echo $category>
                                    <option value="Hat Box">Hat Box</option>
                                    <option value="Long Box">Long Box</option>
                                    <option value="Flower Stand">Flower Stand</option>
                                </select>
                            </div>
                        </div>


                        <!-- Image -->
                        <div class="form-group row">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                             <div class="col-md-6">
                            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image"/>
                            @error('image')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-4 text-center buttons">
                            <input type="submit" class="spring-btn btn-lg btn-block"/>
                            <!-- <a href="{{url('/bouquets')}}"  class="btn btn-primary word">Cancel</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection