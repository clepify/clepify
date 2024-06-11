@role('lecturer')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Hello, <span class="text-primary">{{ auth()->user()->name }}</span></h3>
                <p class="font-italic">
                    Update profile and password here.
                </p>
                @include('components.alert')
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" disabled required
                                    value="{{ auth()->user()->name }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="username">NIP</label>
                                <input class="form-control" type="text" name="username" disabled required
                                    value="{{ auth()->user()->username }}">
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" required
                                    value="{{ auth()->user()->email }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                                @error('current_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <input class="form-control" type="password" name="password" required>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input class="form-control" type="password" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Password <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endrole
