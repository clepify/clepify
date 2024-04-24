<!-- edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Study Program')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Study Program</div>

                    <div class="card-body">
                        <!-- Form for editing an existing study program -->
                        <form action="{{ route('study_programs.update', $studyProgram->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Study Program Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $studyProgram->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
