@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item active"><span>Dashboard</span></li>
    </ol>
@endsection

@section('content')
    <div class="container-lg">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card mb-4 text-white bg-primary">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">89.9%</div>
                        <div>Widget title</div>
                        <div class="progress progress-white progress-thin my-2">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div><small class="text-medium-emphasis-inverse">Widget helper text</small>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card mb-4 text-white bg-warning">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">12.124</div>
                        <div>Widget title</div>
                        <div class="progress progress-white progress-thin my-2">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div><small class="text-medium-emphasis-inverse">Widget helper text</small>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card mb-4 text-white bg-danger">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">$98.111,00</div>
                        <div>Widget title</div>
                        <div class="progress progress-white progress-thin my-2">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div><small class="text-medium-emphasis-inverse">Widget helper text</small>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card mb-4 text-white bg-info">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">2 TB</div>
                        <div>Widget title</div>
                        <div class="progress progress-white progress-thin my-2">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div><small class="text-medium-emphasis-inverse">Widget helper text</small>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
@endpush
