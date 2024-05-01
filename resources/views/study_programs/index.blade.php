@extends('layouts.app')

@section('title', 'Study Programs')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Study Programs</span></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <span class="fs-5">Study Programs</span>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('study_programs.create') }}" class="btn btn-primary">Add New Study Program</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <livewire:study-program-table />
        </div>
    </div>
@endsection
