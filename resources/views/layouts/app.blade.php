@extends('layouts.main')

@section('body')

    <body>
        @include('layouts.sidebar')
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            @include('layouts.header')
            <main class="body flex-grow-1 px-3">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </body>
@endsection
