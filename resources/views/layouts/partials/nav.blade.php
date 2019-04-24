<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Fast in Time</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        </div>
    </div>
</nav>
