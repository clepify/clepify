@extends('layouts.app')

@section('title', 'Add Template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Template</div>

                    <div class="card-body">
                        <form action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @include('components.alert')

                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" hidden>Select Type</option>
                                    <option value="Absence">Absence</option>
                                    <option value="Request">Request</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="document" class="form-label">
                                    Template Document
                                </label>
                                <input class="form-control" type="file" id="document" name="document"
                                    accept=".doc, .docx" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Template</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
