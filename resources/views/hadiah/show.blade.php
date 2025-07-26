@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('hadiah.index') }}">Daftar Hadiah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Hadiah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="detail-hadiah">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="height: 50px" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" style="height: 50px" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Hadiah</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <strong>Nama Hadiah:</strong>
                            </div>
                            <div class="col-lg-9">
                                {{ $hadiah->nama_hadiah }}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <strong>Deskripsi:</strong>
                            </div>
                            <div class="col-lg-9">
                                {{ $hadiah->deskripsi }}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <strong>Jumlah:</strong>
                            </div>
                            <div class="col-lg-9">
                                {{ $hadiah->jumlah }}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <strong>Tanggal Awal:</strong>
                            </div>
                            <div class="col-lg-9">
                                {{ $hadiah->tanggal_awal }}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <strong>Tanggal Akhir:</strong>
                            </div>
                            <div class="col-lg-9">
                                {{ $hadiah->tanggal_akhir }}
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-start gap-3">
                                {{-- Tombol Kembali --}}
                                <a href="{{ route('hadiah.index') }}" class="btn btn-primary rounded-pill"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
                                    <i class="bi bi-arrow-left"></i>
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('hadiah.edit', $hadiah->uuid) }}" class="btn btn-warning rounded-pill"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('hadiah.destroy', $hadiah->uuid) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus hadiah ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Permanen">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        </script>
    </section>
@endsection
