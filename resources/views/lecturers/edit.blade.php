@extends('layouts.app')

@section('title', 'Add Lecturer')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Lecturer</div>

                    <div class="card-body">
                        <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('components.alert')

                            <div class="mb-3">
                                <label for="name" class="form-label">Lecturer Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $lecturer->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $lecturer->username }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $lecturer->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male" @if ($lecturer->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if ($lecturer->gender == 'female') selected @endif>Female</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $lecturer->phone }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Lecturer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
