@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Daftar Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Sub-Kategori</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Sub-Kategori untuk: {{ $category->treatment_type }}</h4>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('kategori.storeSubCategory', $category->uuid) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Nama Sub-Kategori -->
                                <div class="col-md-6 mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Sub-Kategori</label>
                                    <input type="text" id="nama_kategori" class="form-control" name="nama_kategori"
                                        value="{{ old('nama_kategori') }}" placeholder="Nama Sub-Kategori" >
                                </div>

                                <!-- Harga -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" id="price" class="form-control numeric-only" name="price"
                                        value="{{ old('price') }}" placeholder="Harga" >
                                </div>

                                <!-- Estimasi -->
                                <div class="col-md-6 mb-3">
                                    <label for="estimation" class="form-label">Estimasi Selesai</label>
                                    <input type="text" id="estimation" class="form-control numeric-only"
                                        name="estimation" value="{{ old('estimation') }}"
                                        placeholder="Estimasi Selesai (hari)" >
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea id="description" class="form-control" name="description" rows="4" placeholder="Deskripsi">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('kategori.index') }}"
                                        class="btn btn-secondary rounded-pill me-2 mb-1">Batal</a>
                                    <button type="submit" class="btn btn-success rounded-pill me-2 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-warning rounded-pill mb-1">Reset</button>
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
