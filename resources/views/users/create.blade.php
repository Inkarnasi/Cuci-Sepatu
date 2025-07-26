@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create New User</h4>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" style="height: 50px" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="name">Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ old('name') }}" placeholder="Full Name" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="email">Email</label>
                                        <div class="col-lg-9">
                                            <input type="email" id="email" class="form-control" name="email"
                                                value="{{ old('email') }}" placeholder="Email Address" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="password">Password</label>
                                        <div class="col-lg-9">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="role">Role</label>
                                        <div class="col-lg-9">
                                            <select id="role" class="form-control" name="role" autocomplete="off">
                                                <option value="">-- Select Role --</option>
                                                <option value="superadmin">Superadmin</option>
                                                <option value="karyawan">Karyawan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-primary rounded-pill me-1 mb-1">Cancel</a>
                                    <button type="submit" class="btn btn-success rounded-pill me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-warning rounded-pill me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </section>
@endsection
