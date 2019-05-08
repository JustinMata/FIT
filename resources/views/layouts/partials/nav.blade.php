<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Fast in Time</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav form-inline my-2 my-lg-0">
                <ul class="navbar-nav text-uppercase ml-auto">
                @guest
                <li class="nav-item">
                        {{-- @if (Route::has('login')) --}}
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        {{-- @endif --}}
                    </li>
                    <li class="nav-item">
                        {{-- @if (Route::has('register')) --}}
                        <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#register-modal">Register</a>
                        {{-- @endif --}}
                    </li>
                @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Modal 8 -->
<div class="portfolio-modal modal fade" id="register-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center my-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Role') }}</div>

                                <div class="card-body">
                                    <form method="GET" action="{{ route('role') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="type" class="col-md-4 col-form-label text-md-right">Role</label>

                                            <div class="col-md-6">
                                                <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                                                    <option value="" class="input-xlarge">Select your role</option>
                                                    <option value="driver">Driver</option>
                                                    <option value="restaurant">Restaurant</option>
                                                </select>

                                                @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Go') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
