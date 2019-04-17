<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'FIT') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link {{ Request::is('*dashboard') ? 'active' : '' }}" href="{{ route('driverDashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link {{ Request::is('*orders') ? 'active' : '' }}" href="{{ route('driverOrders') }}">Orders <span class="sr-only">(current)</span></a>

            </div>
            <div class="navbar-nav form-inline my-2 my-lg-0">

                @guest
                <a class="nav-item nav-link {{ Request::is('login*') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>

                @if (Route::has('register'))
                <a class="nav-item nav-link {{ Request::is('register*') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

                @else
                <a id="navbarDropdown" class="nav-item nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->first_name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ route('driverDashboard') }}">{{ __('Driver View') }}</a>
                    <a class="dropdown-item" href="{{ route('restaurantDashboard') }}">{{ __('Restaurant View') }}</a>
                    <a class="dropdown-item" href="{{ route('adminDashboard') }}">{{ __('Admin View') }}</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @endguest

            </div>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
