@extends('layouts.main')

@section('body')

  <body>
    <main>
      <section class="min-vh-100 bg-primary d-flex align-items-center px-2 py-3">
        <div class="container">
          <div class="row gx-2 align-items-center">
            <div class="col-12 col-lg-7 d-none d-lg-block">
              <div class="d-flex text-white">
                <div class="col-10">
                  <img src="{{ asset('/images/auth-illustration.svg') }}" alt="" width="600" height="600">
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              @yield('content')
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
@endsection
