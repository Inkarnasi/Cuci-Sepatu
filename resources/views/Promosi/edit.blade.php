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
            <li class="breadcrumb-item active" aria-current="page">Edit Promosi</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="horizontal-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Promosi</h4>
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
                        <form method="POST" action="{{ route('promosi.update', $promosi->uuid) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Tambahkan ini untuk metode update -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="nama_promosi">Nama Promosi</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="nama_promosi" class="form-control" name="nama_promosi"
                                                value="{{ old('nama_promosi', $promosi->nama_promosi) }}"
                                                placeholder="Nama Promosi">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="kode">Kode Promosi</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="kode" class="form-control" name="kode"
                                                value="{{ old('kode', $promosi->kode) }}" placeholder="Kode Promosi">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="start_date">Tanggal Mulai</label>
                                        <div class="col-lg-9">
                                            <input type="date" id="start_date" class="form-control" name="start_date"
                                                value="{{ old('start_date', $promosi->start_date ? \Carbon\Carbon::parse($promosi->start_date)->format('Y-m-d') : '') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="end_date">Tanggal Berakhir</label>
                                        <div class="col-lg-9">
                                            <input type="date" id="end_date" class="form-control" name="end_date"
                                                value="{{ old('end_date', $promosi->end_date ? \Carbon\Carbon::parse($promosi->end_date)->format('Y-m-d') : '') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="discount">Diskon</label>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <?php
                                                $datadiscount = $promosi->discount * 100;
                                                ?>
                                                <input type="number" id="discount" class="form-control" name="discount"
                                                    value="{{ old('discount', $datadiscount) }}" placeholder="Diskon"
                                                    min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="minimum_payment">Minimal Pembayaran</label>
                                        <div class="col-lg-9">
                                            <input type="number" id="minimum_payment" class="form-control" name="minimum_payment"
                                                value="{{ old('minimum_payment',  $promosi->minimum_payment) }}" placeholder="Minimal Pembayaran">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="terms_conditions">Ketentuan</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="terms_conditions" class="form-control" name="terms_conditions"
                                                value="{{ old('terms_conditions',  $promosi->terms_conditions) }}" placeholder="Ketentuan dan Kondisi">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-form-label" for="image">Gambar</label>
                                        <div class="col-lg-9">
                                            <input type="file" id="image" class="form-control" name="image"
                                                accept="image/*">
                                            @if ($promosi->image)
                                                <p>Gambar Saat Ini: <img
                                                        src="{{ asset('images/promosi/' . $promosi->image) }}"
                                                        alt="image" width="100"></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
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
                            </style>
                            <div class="form-group">
                                <label class="form-label" for="description">Deskripsi</label>
                                <textarea id="description" class="form-control" name="description" rows="4" placeholder="Deskripsi Promosi">{{ old('description', $promosi->description) }}</textarea>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-lg-3 col-form-label" for="description">Deskripsi</label>
                                    <div class="col-lg-9">
                                        <textarea id="description" class="form-control" name="description" rows="4" placeholder="Deskripsi Promosi"
                                            style="resize: none;">{{ old('description', $promosi->description) }}</textarea>
                                    </div>
                                </div>
                            </div> --}}


                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('promosi.index') }}"
                                        class="btn btn-primary rounded-pill me-1 mb-1">
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
@endsection
