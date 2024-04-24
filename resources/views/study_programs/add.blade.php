<!-- create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Study Program')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Study Program</div>

                    <div class="card-body">
                        <!-- Form for creating a new study program -->
                        <form action="{{ route('study_programs.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Study Program Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
