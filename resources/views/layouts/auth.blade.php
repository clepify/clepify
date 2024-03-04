@extends('layouts.main')

@section('body')

    <body>
        <main>
            <section class="py-3 py-md-5 py-xl-8 min-vh-100 d-flex align-items-center"
                style="background: linear-gradient(135deg, hsla(221, 57%, 33%, 1) 0%, hsla(229, 50%, 50%, 1) 100%);">
                <div class="container">
                    <div class="row gx-2 align-items-center">
                        <div class="col-12 col-lg-7 d-none d-lg-block">
                            <div class="d-flex text-white">
                                <div class="col-10">
                                    <h1>{{ config('app.name', 'CLEPify') }}</h1>
                                    <hr class="border-primary-subtle mb-5">
                                    <h2 class="h1 mb-4">Campus Letter Efficiency Practicum</h2>
                                    <p class="lead mb-5">Sistem Informasi Manajemen Persuratan Mahasiswa Berbasis Web Di
                                        Jurusan Teknologi Informasi Politeknik Negeri Malang.</p>
                                    <div class="text-endx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                            fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                                            <path
                                                d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </div>
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
