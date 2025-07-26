@extends('Layouts_new.index')

<style>
    .alert {
        position: relative;
    }

    .btn-close {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }
</style>

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('promosi.index') }}">Daftar Promosi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Daftar Promosi</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Promosi</h4>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" style="height: 50px"
                            role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <!-- Perhatikan untuk file upload, tambahkan enctype -->
                        <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                            @csrf
                            <style>
                                .form-group {
                                    display: flex;
                                    align-items: flex-start;
                                    margin-bottom: 1rem;
                                }

                                .form-label {
                                    width: 100px;
                                    padding-top: 0.5rem;
                                    margin-right: 1rem;
                                }

                                #description {
                                    flex: 1;
                                    min-height: 100px;
                                }

                                #nama_kategori {
                                    flex: 1;
                                }
                            </style>
                            <div class="form-group">
                                <label class="form-label" for="treatment_type">Nama Kategori</label>
                                <input type="text" id="treatment_type" class="form-control" name="treatment_type"
                                    value="{{ old('treatment_type') }}" placeholder="Nama Kategori">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Deskripsi</label>
                                <textarea id="description" class="form-control" name="description" rows="4" placeholder="Deskripsi Promosi">{{ old('description') }}</textarea>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('kategori.index') }}" class="btn btn-primary rounded-pill me-1 mb-1">
                                        Batal
                                    </a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var numericInputs = document.querySelectorAll('.numeric-only');

            numericInputs.forEach(function(input) {
                input.addEventListener('input', function(e) {
                    // Remove any non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                input.addEventListener('keypress', function(e) {
                    // Prevent non-numeric key presses
                    if (e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection
