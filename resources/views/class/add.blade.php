@extends('layouts.app')

@section('title', 'Add Class')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Add New Class</div>

          <div class="card-body">
            <form action="{{ route('classes.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>

              <div class="mb-3">
                <label for="study_program_id" class="form-label">Study Program</label>
                <select class="form-select" id="study_program_id" name="study_program_id">
                  <option selected disabled>Select Study Program</option>
                  @foreach ($studyPrograms as $studyProgram)
                    <option value="{{ $studyProgram->id }}">{{ $studyProgram->name }}</option>
                  @endforeach
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Add Class</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
