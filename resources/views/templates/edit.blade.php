@extends('layouts.app')

@section('title', 'Edit Template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Template</div>

                    <div class="card-body">
                        <form action="{{ route('templates.update', $template->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('components.alert')

                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" hidden>Select Type</option>
                                    <option value="Absence" {{ $template->type == 'Absence' ? 'selected' : '' }}>Absence
                                    </option>
                                    <option value="Request" {{ $template->type == 'Request' ? 'selected' : '' }}>Request
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" hidden>Select Category</option>
                                    @if ($template->type === 'Absence')
                                        <option value="Sick" {{ $template->category === 'Sick' ? 'selected' : '' }}>Sick
                                        </option>
                                        <option value="Permission"
                                            {{ $template->category === 'Permission' ? 'selected' : '' }}>Permission</option>
                                        <option value="Dispensation"
                                            {{ $template->category === 'Dispensation' ? 'selected' : '' }}>Dispensation
                                        </option>
                                        <option value="Other" {{ $template->category === 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    @elseif ($template->type === 'Request')
                                        <option value="Recommendation"
                                            {{ $template->category === 'Recommendation' ? 'selected' : '' }}>Recommendation
                                        </option>
                                        <option value="Certificate"
                                            {{ $template->category === 'Certificate' ? 'selected' : '' }}>Certificate
                                        </option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="document" class="form-label">
                                    Template Document
                                </label>
                                <input class="form-control" type="file" id="document" name="document"
                                    accept=".doc, .docx" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Template</button>
                        </form>
                    </div>
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
    </script>
@endpush
