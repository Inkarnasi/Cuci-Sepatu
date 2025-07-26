@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('hadiah.index') }}">Daftar Hadiah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Hadiah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Hadiah</h4>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('hadiah.store') }}">
                            @csrf
                            <div class="form-group row align-items-center">
                                <label class="col-lg-3 col-form-label" for="nama_hadiah">Nama Hadiah</label>
                                <div class="col-lg-9">
                                    <input type="text" id="nama_hadiah" class="form-control" name="nama_hadiah"
                                        placeholder="Nama Hadiah">
                                </div>
                            </div>

                            <div class="form-group row align-items-center mt-3">
                                <label class="col-lg-3 col-form-label" for="deskripsi">Deskripsi</label>
                                <div class="col-lg-9">
                                    <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Deskripsi Hadiah"></textarea>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mt-3">
                                <label class="col-lg-3 col-form-label" for="jumlah">Jumlah</label>
                                <div class="col-lg-9">
                                    <input type="number" id="jumlah" class="form-control" name="jumlah"
                                        placeholder="Jumlah Hadiah">
                                </div>
                            </div>

                            <div class="form-group row align-items-center mt-3">
                                <label class="col-lg-3 col-form-label" for="tanggal_awal">Tanggal Awal</label>
                                <div class="col-lg-9">
                                    <input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal">
                                </div>
                            </div>

                            <div class="form-group row align-items-center mt-3">
                                <label class="col-lg-3 col-form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                <div class="col-lg-9">
                                    <input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('hadiah.index') }}" class="btn btn-primary rounded-pill me-1 mb-1">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-success rounded-pill me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-warning rounded-pill me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
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
                </div>
            </div>
        </div>
    </section>
@endsection
