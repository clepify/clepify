@extends('layouts.app')

@section('title', 'Edit Letter')

@section('breadcrumb')
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
        <li class="breadcrumb-item active"><span>Edit Letter</span></li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">Upload Letter</div>
                <div class="card-body">
                    <form id="letter-form" action="{{ route('letters.update', $letter->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                                    disabled style="background-color: #d8dbe0 !important;">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $letter->date ? substr($letter->date, 0, 10) : date('Y-m-d') }}" required>
                            </div>
                            <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" hidden>Select Type</option>
                                    <option value="Absence" {{ $letter->type === 'Absence' ? 'selected' : '' }}>Absence
                                    </option>
                                    <option value="Request" {{ $letter->type === 'Request' ? 'selected' : '' }}>Request
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" hidden>Select Category</option>
                                    @if ($letter->type === 'Absence')
                                        <option value="Sick" {{ $letter->category === 'Sick' ? 'selected' : '' }}>Sick
                                        </option>
                                        <option value="Permission"
                                            {{ $letter->category === 'Permission' ? 'selected' : '' }}>Permission</option>
                                        <option value="Dispensation"
                                            {{ $letter->category === 'Dispensation' ? 'selected' : '' }}>Dispensation
                                        </option>
                                        <option value="Other" {{ $letter->category === 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    @elseif ($letter->type === 'Request')
                                        <option value="Recommendation"
                                            {{ $letter->category === 'Recommendation' ? 'selected' : '' }}>Recommendation
                                        </option>
                                        <option value="Certificate"
                                            {{ $letter->category === 'Certificate' ? 'selected' : '' }}>Certificate
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="lecturer" class="form-label">Lecturer</label>
                                <select class="form-select" id="lecturer" name="lecturer" disabled>
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id }}"
                                            {{ $letter->lecturer[0]->name === $lecturer->name ? 'selected' : '' }}>
                                            {{ $lecturer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="letter_document" class="form-label">Letter Document</label>
                                <input class="form-control" type="file" id="letter_document" name="letter_document"
                                    accept="application/pdf">
                                @if ($letter->letter_document)
                                    <a href="{{ asset('storage/letters/' . $letter->letter_document) }}" target="_blank">
                                        View Document
                                    </a>
                                @endif
                            </div>
                            <div class="col-12 mb-3">
                                <label for="support_document" class="form-label">Support Document</label>
                                <input class="form-control" type="file" id="support_document" name="support_document"
                                    accept="application/pdf">
                                @if ($letter->support_document)
                                    <a href="{{ asset('storage/letters/' . $letter->support_document) }}" target="_blank">
                                        View Document
                                    </a>
                                @endif
                            </div>
                        </div>
                        @include('components.alert')
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required>
                            <label class="form-check ps-2" for="confirmation">
                                I confirm that the information provided is true and accurate.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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

        const lecturer = document.querySelector('.form-multi-select');
        const selectedLecturers = {!! json_encode($letter_lecturers) !!};
        selectedLecturers.forEach(id => {
            const option = lecturer.querySelector(`option[value="${id}"]`);
            if (option) {
                option.selected = true;
            }
        });
    </script>
@endpush
