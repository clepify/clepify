@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="card border-0 rounded-2">
        <div class="card-body p-4 p-xl-5">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <h3 class="text-center">
                            <b>Login</b>
                        </h3>
                        @if (Session::has('account_deactivated'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ Session::get('account_deactivated') }}
                            </div>
                        @endif
                        @error('email')
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Username or Email" value="{{ old('email') }}" autocomplete="email" required
                                autofocus>
                            <label for="email" class="form-label">Username or Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" autocomplete="current-password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
