@extends('layouts.app')

@section('title', 'Create Letter')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Create Letter</span></li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center mb-4">
        {{-- <div class="col-12 col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Letter Template</div>
                <div class="card-body">
                    <form action="{{ route('letters.letter-template') }}">
                        <div class="mb-3">
                            <label for="letter_template" class="form-label">Letter Template</label>
                            <select class="form-select" id="letter_template" required>
                                <option value="" hidden>Select Letter Template</option>
                                <option value="Absence">Absence</option>
                                <option value="Request">Request</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Download</button>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">Upload Letter</div>
                <div class="card-body">
                    <form id="letter-form" action="{{ route('letters.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                                    disabled style="background-color: #d8dbe0 !important;">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="date" class="form-label">Date of Letter</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ old('date') ? old('date') : date('Y-m-d') }}" required>
                            </div>
                            <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" hidden>Select Type</option>
                                    <option value="Absence">Absence</option>
                                    <option value="Request">Request</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required disabled>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="lecturer[]" class="form-label">Lecturer(s)</label>
                                <select class="form-multi-select" id="lecturer[]" data-coreui-search="true"
                                    data-coreui-select-all="false" multiple>
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="letter_document" class="form-label">
                                    Letter Document <small class="text-secondary">(PDF only, max 2MB)</small>
                                </label>
                                <input class="form-control" type="file" id="letter_document" name="letter_document"
                                    accept="application/pdf" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="support_document" class="form-label">
                                    Support Document <small class="text-secondary">(PDF only, max 2MB)</small>
                                </label>
                                <input class="form-control" type="file" id="support_document" name="support_document"
                                    accept="application/pdf">
                            </div>
                        </div>
                        @include('components.alert')
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required>
                            <label class="form-check ps-2" for="confirmation">
                                I confirm that the information provided is true and accurate.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const type = document.querySelector('#type');
        const category = document.querySelector('#category');
        const absence = ['Sick', 'Permission', 'Dispensation', 'Other'];
        const request = ['Recommendation', 'Certificate', 'Transcript', 'Other'];

        type.addEventListener('change', function() {
            category.innerHTML = '';
            category.disabled = false;
            if (type.value === 'Absence') {
                absence.forEach(function(item) {
                    const option = document.createElement('option');
                    option.value = item;
                    option.text = item;
                    category.appendChild(option);
                });
            } else if (type.value === 'Request') {
                request.forEach(function(item) {
                    const option = document.createElement('option');
                    option.value = item;
                    option.text = item;
                    category.appendChild(option);
                });
            }
        });

        const letterForm = document.querySelector('#letter-form');
        const letterButton = letterForm.querySelector('button[type="submit"]');

        letterForm.addEventListener('submit', function() {
            letterButton.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...';
            letterButton.disabled = true;
        });
    </script>
@endpush
