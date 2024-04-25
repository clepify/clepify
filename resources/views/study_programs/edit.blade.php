<!-- edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Study Program')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Study Program</div>

                    <div class="card-body">
                        <!-- Form for editing an existing study program -->
                        <form action="{{ route('study_programs.update', $studyProgram->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-select" id="level" name="level" required>
                                    <option value="D4" {{ $studyProgram->level == 'D4' ? 'selected' : '' }}>D4</option>
                                    <option value="D3" {{ $studyProgram->level == 'D3' ? 'selected' : '' }}>D3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ $studyProgram->code }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Study Program Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $studyProgram->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
