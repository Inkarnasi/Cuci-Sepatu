@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Daftar Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Kategori</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Kategori</h6>
        </div>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nama Treatment:</div>
                <div class="col-md-9">{{ $category->treatment_type }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Deskripsi:</div>
                <div class="col-md-9">
                    @if (!empty($category->description))
                        {{ $category->description }}
                    @else
                        <span class="text-muted">Tidak ada deskripsi tersedia</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                <a href="{{ route('kategori.edit', $category->uuid) }}" class="btn btn-primary mr-2">Edit</a>

                <form action="{{ route('kategori.destroy', $category->uuid) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
