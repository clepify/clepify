@extends('layouts.main')

@section('body')

    <body>
        {{-- @role('admin', 'lecturer') --}}
        @include('layouts.sidebar')
        {{-- @endrole --}}
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            @include('layouts.header')
            <main class="body flex-grow-1 @role('student') container-lg @endrole px-3">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
        @stack('scripts')
    </body>
@endsection
