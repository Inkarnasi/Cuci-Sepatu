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

    #deskripsi {
        flex: 1;
        min-height: 100px;
    }
</style>

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('hadiah.index') }}">Daftar Hadiah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hadiah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Hadiah</h4>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" style="height: 50px"
                            role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <!-- Form for editing the hadiah -->
                        <form method="POST" action="{{ route('hadiah.update', $hadiah->uuid) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="nama_hadiah">Nama Hadiah</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="nama_hadiah" class="form-control" name="nama_hadiah"
                                                value="{{ $hadiah->nama_hadiah }}" placeholder="Nama Hadiah">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" placeholder="Deskripsi Hadiah">{{ $hadiah->deskripsi }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="jumlah">Jumlah</label>
                                        <div class="col-lg-9">
                                            <input type="number" id="jumlah" class="form-control numeric-only"
                                                name="jumlah" value="{{ $hadiah->jumlah }}" placeholder="Jumlah Hadiah">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="tanggal_awal">Tanggal Awal</label>
                                        <div class="col-lg-9">
                                            <input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal"
                                                value="{{ $hadiah->tanggal_awal }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                        <div class="col-lg-9">
                                            <input type="date" id="tanggal_akhir" class="form-control"
                                                name="tanggal_akhir" value="{{ $hadiah->tanggal_akhir }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('hadiah.index') }}" class="btn btn-primary rounded-pill me-1 mb-1">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-success rounded-pill me-1 mb-1">Update</button>
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
