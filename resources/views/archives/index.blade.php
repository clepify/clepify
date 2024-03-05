@extends('layouts.app')

@section('title', 'Archives')

@section('breadcrumb')
  <ol class="breadcrumb my-0 ms-2">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
    <li class="breadcrumb-item active"><span>Archives</span></li>
  </ol>
@endsection

@section('content')
  <div class="alert alert-primary" role="alert">
    This is archives page.
  </div>
@endsection
