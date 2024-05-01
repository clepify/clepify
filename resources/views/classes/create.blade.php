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

                            @include('components.alert')

                            <div class="mb-3">
                                <label for="study_program_id" class="form-label">Study Program</label>
                                <select class="form-select" id="study_program_id" name="study_program_id" required>
                                    <option selected hidden>Select Study Program</option>
                                    @foreach ($study_programs as $study_program)
                                        <option value="{{ $study_program->id }}">{{ $study_program->level }} -
                                            {{ $study_program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Class Level</label>
                                <select class="form-select" id="level" name="level" required>
                                    <option selected hidden>Select Class Level</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Class Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Class</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
