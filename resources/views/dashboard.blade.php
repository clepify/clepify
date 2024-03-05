@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
  <ol class="breadcrumb my-0 ms-2">
    <li class="breadcrumb-item active"><span>Dashboard</span></li>
  </ol>
@endsection

@section('content')
  @role('student')
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome</h4>
      <p>
        This is your dashboard. You can send a letter to your lecturer from here.
      </p>
      <hr>
      <a href="{{ route('letters') }}" class="btn btn-primary">
        <i class="bi bi-send"></i>
        Send letter
      </a>
    </div>
  @endrole
  @role('admin')
    <div class="container-lg">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card bg-primary mb-4 text-white">
            <div class="card-body">
              <div class="fs-4 fw-semibold">89.9%</div>
              <div>Widget title</div>
              <small class="text-medium-emphasis-inverse">Widget helper text</small>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card bg-warning mb-4 text-white">
            <div class="card-body">
              <div class="fs-4 fw-semibold">12.124</div>
              <div>Widget title</div>
              <small class="text-medium-emphasis-inverse">Widget helper text</small>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card bg-danger mb-4 text-white">
            <div class="card-body">
              <div class="fs-4 fw-semibold">$98.111,00</div>
              <div>Widget title</div>
              <small class="text-medium-emphasis-inverse">Widget helper text</small>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card bg-info mb-4 text-white">
            <div class="card-body">
              <div class="fs-4 fw-semibold">2 TB</div>
              <div>Widget title</div>
              <small class="text-medium-emphasis-inverse">Widget helper text</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endrole
@endsection
