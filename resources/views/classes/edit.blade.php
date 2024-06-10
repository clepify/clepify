@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Class</div>

                    <div class="card-body">
                        <form action="{{ route('classes.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('components.alert')

                            <div class="mb-3">
                                <label for="study_program_id" class="form-label">Study Program</label>
                                <select class="form-control" id="study_program_id" name="study_program_id">
                                    @foreach ($studyPrograms as $studyProgram)
                                        <option value="{{ $studyProgram->id }}"
                                            {{ $class->study_program_id == $studyProgram->id ? 'selected' : '' }}>
                                            {{ $studyProgram->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Class Level</label>
                                <select class="form-select" id="level" name="level" required>
                                    <option selected hidden>Select Class Level</option>
                                    <option value="1" {{ $class->level == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $class->level == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $class->level == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $class->level == 4 ? 'selected' : '' }}>4</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name">Class Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $class->name }}">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
