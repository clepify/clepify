@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
  <ol class="breadcrumb my-0 ms-2">
    <li class="breadcrumb-item active"><span>Dashboard</span></li>
  </ol>
@endsection

@section('content')
  @include('dashboard.admin')
  @include('dashboard.student')
@endsection
