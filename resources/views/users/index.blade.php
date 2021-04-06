@extends('layouts.app')

@section('title', 'My Profile')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
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

.about-text {
    color: white;
    padding: 1.85rem;
}

.about-text h2 {
    font-family: AdihausDIN, Helvetica, Arial, sans-serif;
    font-style: normal;
}

.card-title {
    font-family: 'Lato', sans-serif;

}

.sead {
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 14px;
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
    <h2>PERSONAL INFORMATION</h2>
    <a href="/">Home</a>
    /
    <span>My Profile</span>
    
    <div class="row">
        <div class="col-lg-6 buttons">
        <hr>
            @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif
            <br>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', $user->email) }}" readonly>
                </div>

                <div class="form-group">

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </form>
            <br><hr>
            <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                onSubmit="return confirm('Are you sure you want delete your account?');">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-lg btn-block">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<div style="height: 100px;"></div>

@endsection