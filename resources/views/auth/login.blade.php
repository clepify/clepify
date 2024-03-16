@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="card rounded-2 border-0">
    <div class="card-body p-xl-5 p-4">
      <div class="row">
        <div class="col-12">
          <div class="mb-4">
            <div class="text-center">
              <img src="{{ asset('/images/CLEPify.png') }}" alt="CLEPify Logo" width="160">
              <p class="fs-5 mt-2">
                Login to your account
              </p>
            </div>
            @if ($errors->any())
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-3" role="alert">
                  {{ $error }}
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row gy-3 overflow-hidden">
          <div class="col-12">
            <div class="form-floating mb-2">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username or Email"
                value="{{ old('username') }}" autocomplete="username" required autofocus>
              <label for="email" class="form-label">Username or Email</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating mb-2">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                autocomplete="current-password" required>
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
          <div class="d-flex gap-md-4 flex-column flex-md-row justify-content-md-between gap-2">
            @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('#login-form');
    const loginButton = loginForm.querySelector('button[type="submit"]');

    loginForm.addEventListener('submit', function() {
      loginButton.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
      loginButton.disabled = true;
    });
  });
</script>
