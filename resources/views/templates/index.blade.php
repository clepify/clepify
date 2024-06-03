@extends('layouts.app')

@section('title', 'Templates')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Templates</span></li>
    </ol>
@endsection

@section('content')
    @role('admin')
        <div class="card">
            <div class="card-header">
                <span class="fs-5">Templates</span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('templates.create') }}" class="btn btn-primary">Add New Template</a>
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
                <livewire:template-table />
            </div>
        </div>
    @endrole
    @role('student', 'lecturer')
        <div class="row">
            @foreach ($templates as $template)
                <div class="col-md-4">
                    <div class="card mb-4">
                        {{-- <img src="{{ $template->image }}" class="card-img-top" alt="{{ $template->name }}"> --}}
                        <div class="card-body">
                            <p class="card-text">Type: {{ $template->type }}</p>
                            <p class="card-text">Category: {{ $template->category }}</p>
                            <a href="{{ 'storage/templates/' . $template->document }}" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endrole
@endsection
