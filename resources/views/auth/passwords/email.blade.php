@extends('layouts.auth')

@section('content')
    <div class="card border-0 rounded-2">
        <div class="card-body p-4 p-xl-5">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <h3 class="text-center"><b>Reset Password</b></h3>
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email Address" value="{{ old('email') }}" autocomplete="email" required
                                autofocus>
                            <label for="email" class="form-label">Email Address</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Send Password Reset Link</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-4">
                        <a class="btn btn-link" href="{{ route('login') }}">
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
