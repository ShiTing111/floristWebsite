@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <br>
                <h2 style="text-align: center"> Create New Bouquet </h2>
                <br>
                <div class="card-body">
                    <form action="{{ route('bouquets.store') }}" method="POST" enctype="multipart/form-data" 
                        onSubmit="return confirm('Are you sure you wish to register this car?');">
                        
                        <!-- Title -->
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
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
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
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
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Size -->
                        <div class="form-group row">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Size') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" required autocomplete="size" autofocus>
                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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