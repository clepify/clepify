@extends('layouts.app')

@section('title', 'Create Letter')

@section('breadcrumb')
  <ol class="breadcrumb my-0 ms-2">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>
    <li class="breadcrumb-item active"><span>Create Letter</span></li>
  </ol>
@endsection

@section('content')
  <div class="row mb-4">
    <div class="col-12 col-md-4 mb-3">
      <div class="card">
        <div class="card-header">Letter Template</div>
        <div class="card-body">
          <div class="mb-3">
            <label for="letter_template" class="form-label">Letter Template</label>
            <select class="form-select" id="letter_template">
              <option value="" hidden>Select Letter Template</option>
              <option value="Absence">Absence</option>
              <option value="Request">Request</option>
            </select>
          </div>
          <button class="btn btn-primary">Download</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-header">Upload Letter</div>
        <div class="card-body">
          <form id="letter-form" action="{{ route('letters.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                  name="nim" value="{{ Auth::user()->username }}" disabled>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                  name="name" value="{{ Auth::user()->name }}" disabled>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                <label for="date_sent" class="form-label">Date Sent</label>
                <div data-coreui-date="{{ old('date_sent') ? old('date_sent') : date('Y-m-d') }}"
                  data-coreui-footer="true" data-coreui-locale="en-UK" data-coreui-toggle="date-picker"></div>
                @error('date_sent')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <label for="duration" class="form-label">Duration</label>
                <select class="form-select @error('duration') is-invalid @enderror" id="duration" name="duration"
                  required>
                  <option value="" hidden>Select Duration</option>
                  <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>1 Day</option>
                </select>
                @error('type')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-6 pe-lg-0 mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                  <option value="" hidden>Select Type</option>
                  <option value="Absence" {{ old('type') == 'Absence' ? 'selected' : '' }}>Absence</option>
                  <option value="Request" {{ old('type') == 'Request' ? 'selected' : '' }}>Request</option>
                </select>
                @error('type')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category"
                  required disabled>
                </select>
                @error('category')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 mb-3">
                <label for="lecturer[]" class="form-label">Lecturer(s)</label>
                <select class="form-multi-select" id="lecturer[]" data-coreui-search="true" data-coreui-select-all="false"
                  multiple required>
                  @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 mb-3">
                <label for="letter_document" class="form-label">Letter Document</label>
                <input class="form-control @error('letter_document') is-invalid @enderror" type="file"
                  id="letter_document" name="letter_document" accept="application/pdf" required>
                @error('file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 mb-3">
                <label for="support_document" class="form-label">Support Document</label>
                <input class="form-control @error('support_document') is-invalid @enderror" type="file"
                  id="support_document" name="support_document" accept="application/pdf">
                @error('file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
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
    const absence = ['Sick', 'Family', 'Religious', 'Other'];
    const request = ['Assignment', 'Exam', 'Other'];

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
