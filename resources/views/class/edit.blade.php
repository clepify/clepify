@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Class</div>

                    <div class="card-body">
                        <!-- Form untuk edit class -->
                        <form action="{{ route('classes.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Class Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="study_program_id">Study Program</label>
                                <select class="form-control" id="study_program_id" name="study_program_id">
                                    @foreach ($studyPrograms as $studyProgram)
                                        <option value="{{ $studyProgram->id }}"
                                            {{ $class->study_program_id == $studyProgram->id ? 'selected' : '' }}>
                                            {{ $studyProgram->name }}</option>
                                    @endforeach
                                </select>
                            <!-- Add more fields here if needed -->
                            <button type="submit" class="btn btn-primary mt-3   ">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
