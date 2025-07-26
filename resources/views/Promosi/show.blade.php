@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('promosi.index') }}">Daftar Promosi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Promosi</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Promosi</h6>
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
                <div class="col-md-3 font-weight-bold">Nama Promosi:</div>
                <div class="col-md-9">{{ $promosi->nama_promosi }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Tanggal Mulai:</div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($promosi->start_date)->format('d-m-Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Tanggal Berakhir:</div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($promosi->end_date)->format('d-m-Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">{{ $promosi->status }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Kode Promosi:</div>
                <div class="col-md-9">{{ $promosi->kode }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Diskon:</div>
                <div class="col-md-9">{{ $promosi->discount * 100 }}%</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Minimum Pembayaran:</div>
                <div class="col-md-9">Rp.{{ number_format($promosi->minimum_payment, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Ketentuan:</div>
                <div class="col-md-9">{{ $promosi->terms_conditions }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Deskripsi:</div>
                <div class="col-md-9">
                    {{-- Jika deskripsi tidak kosong, tampilkan, jika tidak tampilkan pesan default --}}
                    @if (!empty($promosi->description))
                        {{ $promosi->description }}
                    @else
                        <span class="text-muted">Tidak ada deskripsi tersedia</span>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Gambar:</div>
                <div class="col-md-9">
                    {{-- Jika gambar ada, tampilkan, jika tidak tampilkan pesan default --}}
                    @if ($promosi->image)
                        <img src="{{ asset($promosi->image) }}" alt="{{ $promosi->nama_promosi }}" class="img-fluid">
                        {{-- <img src="{{ asset('storage/' . $promosi->image) }}" alt="{{ $promosi->nama_promosi }}"
                            class="img-fluid"> --}}
                    @else
                        <span class="text-muted">Tidak ada gambar tersedia</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('promosi.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                @if (auth()->user()->role == 'superadmin')
                <a href="{{ route('promosi.edit', $promosi->uuid) }}" class="btn btn-primary mr-2">Edit</a>
                <form action="{{ route('promosi.destroy', $promosi->uuid) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus promosi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
