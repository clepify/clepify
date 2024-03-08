@extends('layouts.app')

@section('title', 'Letters')

@section('breadcrumb')
  <ol class="breadcrumb my-0 ms-2">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
    <li class="breadcrumb-item active"><span>Letters</span></li>
  </ol>
@endsection

@section('content')
  <div class="card">
    <div class="card-header">
      <span class="fs-5">My Letters</span>
    </div>
    <div class="card-body">
      <livewire:letter-table />
    </div>
  </div>
@endsection
