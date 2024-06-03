<!-- create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Study Program')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Study Program</div>

                    <div class="card-body">
                        <!-- Form for creating a new study program -->
                        <form action="{{ route('study_programs.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Level</label>
                                <select class="form-select" id="level" name="level" required>
                                    <option value="S2">S2</option>
                                    <option value="D4">D4</option>
                                    <option value="D3">D3</option>
                                    <option value="D2">D2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <div class="mb-3">
                                <label for="name">Study Program Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
