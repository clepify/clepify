@extends('layouts.app')

@section('title', 'Class')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Class</span></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <span class="fs-5">Class</span>
        </div>
        <div class="card-body">
            <div class="d-flex gap-2">
                <div class="mb-3">
                    <a href="{{ route('classes.create') }}" class="btn btn-primary">Add New Class</a>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal"
                        data-coreui-target="#uploadBatchModal">
                        <i class="bi bi-file-earmark-excel-fill"></i>
                        Upload Batch
                    </button>
                </div>
                <div class="modal fade" id="uploadBatchModal" tabindex="-1" aria-labelledby="uploadBatchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('classes.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadBatchModalLabel">Upload Batch Classes</h5>
                                    <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <a href="{{ asset('documents/classes_template.xlsx') }}">
                                            Download Template
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="batch" class="form-label">
                                            <span>Batch File</span>
                                            <small class="text-secondary">(Excel only, max 5MB)</small>
                                        </label>
                                        <input type="file" class="form-control" id="batch" name="batch"
                                            accept=".xlsx,.xls" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-coreui-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('components.alert')
            <livewire:class-table />
        </div>
    </div>
@endsection
