<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">

<div id="app" class="border-bottom">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="/">BLUEMING</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/bouquets') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/users') }}">Profile</a>
                </li>
                @can('isAdmin')
                <li class="nav-item">
                    <a href="{{ url('/orders') }}" class="nav-link">Orders</a>
                </li>
                @endcan
                @can('isUser')
                <li class="nav-item">
                    <a href="{{ url('/carts') }}" class="nav-link">Cart</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/orders') }}" class="nav-link">My Orders</a>
                </li>
                @endcan
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{  url('/register/user') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @can('isAdmin')
                    <div class="btn btn-success">
                        Admin
                    </div>
                    @endcan
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user mx-sm-2"></i>{{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        </div>
    </nav>
  </div>
</nav>
</div>
