@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Daftar Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi #{{ $transaksi->tracking_number }}</h6>
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
            <h5 class="font-weight-bold text-secondary mb-3">Informasi Customer</h5>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nama Customer:</div>
                <div class="col-md-9">{{ $transaksi->nama_customer }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nomor Telepon:</div>
                <div class="col-md-9">{{ $transaksi->notelp_customer }}</div>
            </div>

            <!-- Tampilkan informasi promo -->
            @if ($transaksi->promosi)
                <h5 class="font-weight-bold text-secondary mb-3 mt-4">Informasi Promosi</h5>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Kode Promosi:</div>
                    <div class="col-md-9">{{ $transaksi->promosi->kode }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Diskon:</div>
                    <div class="col-md-9">{{ $transaksi->promosi->discount * 100 }}%</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Deskripsi Promosi:</div>
                    <div class="col-md-9">{{ $transaksi->promosi->description }}</div>
                </div>
            @endif

            <h5 class="font-weight-bold text-secondary mb-3 mt-4">Detail Transaksi</h5>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nama Admin:</div>
                <div class="col-md-9">{{ $transaksi->nama_admin_input }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Total Harga:</div>
                <div class="col-md-9">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status Pembayaran:</div>
                <div class="col-md-9">
                    @if ($transaksi->status == 'paid')
                        <span class="badge bg-success">Paid</span>
                    @elseif ($transaksi->status == 'downpayment')
                        <span class="badge bg-warning">Downpayment</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </div>
            </div>

            <!-- Jika statusnya Downpayment -->
            @if ($transaksi->status == 'downpayment')
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Jumlah Downpayment:</div>
                    <div class="col-md-9">Rp{{ number_format($transaksi->downpayment_amount, 0, ',', '.') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Sisa Pembayaran:</div>
                    <div class="col-md-9">Rp{{ number_format($transaksi->remaining_payment, 0, ',', '.') }}</div>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Tanggal Transaksi:</div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Jam Transaksi:</div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($transaksi->jam_transaksi)->format('H:i:s') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Catatan :</div>
                <div class="col-md-9">{{ $transaksi->note }}</div>
            </div>

            <!-- Tampilkan status pickup saat ini -->
            <h5 class="font-weight-bold text-secondary mb-3 mt-4">Status Pickup</h5>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status Pickup:</div>
                <div class="col-md-9">
                    @if ($transaksi->status_pickup == 'Belum Diambil')
                        <span class="badge bg-warning">Belum diambil</span>
                    @elseif ($transaksi->status_pickup == 'Sudah Diambil')
                        <span class="badge bg-success">Sudah diambil</span>
                    @endif
                </div>
            </div>

            @if ($transaksi->status_pickup == 'Sudah Diambil')
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Tanggal Pengambilan:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($transaksi->tanggal_pickup)->format('d-m-Y') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Jam Pengambilan:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($transaksi->jam_pickup)->format('H:i:s') }}</div>
                </div>
            @endif

            <!-- Form untuk update status pickup -->
            @if ($transaksi->status_pickup == 'Belum Diambil')
                <div class="row mb-4">
                    <div class="col-md-3 font-weight-bold">Ubah Status Pickup:</div>
                    <div class="col-md-9">
                        <form action="{{ route('transaksi.updatePickup', $transaksi->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-link p-0" type="submit" title="Tandai Sudah Diambil">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
      <h5 class="font-weight-bold text-secondary mb-3 mt-4">
                Kategori Harga yang Dipilih
                <button class="btn btn-link p-0" type="button" id="toggleKategoriHarga">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
            <div id="kategoriHargaSection" class="collapse-section">
                <ul class="list-group mb-3">
                    @php
                    $totalKategoriHarga = 0;
                    @endphp
                    @foreach ($transaksi->categoryHargas as $categoryHarga)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $categoryHarga->nama_kategori }}
                        <span>{{ $categoryHarga->pivot->qty }} x
                            Rp{{ number_format($categoryHarga->price, 0, ',', '.') }}</span>
                    </li>
                    @php
                    $totalKategoriHarga += $categoryHarga->pivot->qty * $categoryHarga->price;
                    @endphp
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                        style="background-color: gold; color: black;">
                        Total Kategori Harga
                        <span style="color: black;">Rp{{ number_format($totalKategoriHarga, 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>
            {{-- <h5 class="font-weight-bold text-secondary mb-3 mt-4">
                Kategori Harga yang Dipilih
                <button class="btn btn-link p-0" type="button" id="toggleKategoriHarga">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
            
            <div id="kategoriHargaSection" class="collapse-section">
                @php $totalKategoriHarga = 0; @endphp
            
                @foreach ($categories->where('parent_id', null) as $categoryInduk)
                    @php
                        $selectedSubCategories = $transaksi->categoryHargas->filter(function ($subCategory) use ($categoryInduk) {
                            return $subCategory->parent_id == $categoryInduk->id;
                        });
                    @endphp
            
                    @if ($selectedSubCategories->isNotEmpty())
                        <div class="mb-4">
                            <h5 class="mt-3 mb-3 font-weight-bold text-primary">{{ $categoryInduk->nama_kategori }}</h5>
                            <ul class="list-group">
                                @foreach ($selectedSubCategories as $subCategory)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $subCategory->nama_kategori }}</span>
                                        <span>{{ $subCategory->pivot->qty }} x Rp{{ number_format($subCategory->price, 0, ',', '.') }}</span>
                                    </li>
                                    @php
                                        $totalKategoriHarga += $subCategory->pivot->qty * $subCategory->price;
                                    @endphp
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            
                @if ($totalKategoriHarga > 0)
                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                            style="background-color: gold; color: black;">
                            Total Kategori Harga
                            <span style="color: black;">Rp{{ number_format($totalKategoriHarga, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                @endif
            </div> --}}
            



            @if ($transaksi->plusServices->isNotEmpty())
                    <h5 class="font-weight-bold text-secondary mb-3">
                        Layanan Tambahan
                        <button class="btn btn-link p-0" type="button" id="toggleLayananTambahan">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                    <div id="layananTambahanSection" class="collapse-section">
                        <ul class="list-group mb-3">
                            @php
                                $totalPlusServices = 0;
                            @endphp
@foreach ($transaksi->plusServices as $plusService)
    @php
        $qty = $plusService->pivot->qty ?? 1;
    @endphp
    <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $plusService->name }}
        <span>{{ $qty }} x Rp{{ number_format($plusService->price, 0, ',', '.') }}</span>
    </li>
    @php
        $totalPlusServices += $plusService->price * $qty;
    @endphp
@endforeach

                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                                style="background-color: gold; color: black;">
                                Total Layanan Tambahan
                                <span style="color: black;">Rp{{ number_format($totalPlusServices, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                    </div>
            @endif

            <script>
                // Function to toggle visibility of an element
                function toggleCollapse(sectionId, toggleButton) {
                    const section = document.getElementById(sectionId);
                    const icon = toggleButton.querySelector('i');

                    // Toggle the visibility of the section
                    if (section.style.display === "none" || section.style.display === "") {
                        section.style.display = "block";
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    } else {
                        section.style.display = "none";
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                }

                // Add event listener to the buttons
                document.getElementById('toggleKategoriHarga').addEventListener('click', function () {
                    toggleCollapse('kategoriHargaSection', this);
                });

                document.getElementById('toggleLayananTambahan').addEventListener('click', function () {
                    toggleCollapse('layananTambahanSection', this);
                });

                // By default, hide the sections
                document.getElementById('kategoriHargaSection').style.display = "none";
                document.getElementById('layananTambahanSection').style.display = "none";
            </script>

            <!-- Total Keseluruhan -->
            <h5 class="font-weight-bold text-secondary mb-3 mt-4">Total Keseluruhan</h5>
            <ul class="list-group mb-3">
                @php
                    if ($transaksi->plusServices->isEmpty()) {
                        $totalKeseluruhan = $totalKategoriHarga;
                    } else {
                        $totalKeseluruhan = $totalKategoriHarga + $totalPlusServices;
                    }

                    // Terapkan diskon jika ada promosi
                    if ($transaksi->promosi) {
                        $diskon = $transaksi->promosi->discount * $totalKeseluruhan;
                        $totalSetelahDiskon = $totalKeseluruhan - $diskon;
                    } else {
                        $diskon = 0;
                        $totalSetelahDiskon = $totalKeseluruhan;
                    }

                    if ($memberDiscount > 0) {
                        // dd($totalSetelahDiskon, $memberDiscount);
                        $totalDiskonMember = $totalSetelahDiskon * $memberDiscount;
                        $totalSetelahDiskonMember = $totalSetelahDiskon - $totalDiskonMember;
                        // dd($totalSetelahDiskonMember);
                    }
                @endphp

                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                    style="background-color: gold; color: black;">
                    Subtotal
                    <span style="color: black;">Rp{{ number_format($totalKeseluruhan, 0, ',', '.') }}</span>
                </li>

                @if ($diskon > 0)
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                        Diskon Promo ({{ $transaksi->promosi->discount * 100 }}%)
                        <span>- Rp{{ number_format($diskon, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                        style="background-color: gold; color: black;">
                        Total Setelah Diskon Promo
                        <span style="color: black;">Rp{{ number_format($totalSetelahDiskon, 0, ',', '.') }}</span>
                    </li>
                @endif

                @if ($memberDiscount > 0)
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                        Diskon Member ({{ $memberDiscount * 100 }}%)
                        <span>- Rp{{ number_format($totalDiskonMember, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                        style="background-color: gold; color: black;">
                        Total Setelah Diskon Member
                        <span style="color: black;">Rp{{ number_format($totalSetelahDiskonMember, 0, ',', '.') }}</span>
                    </li>
                @endif


                <!-- Tampilkan detail downpayment jika statusnya adalah 'downpayment' -->
                @if ($transaksi->status == 'downpayment')
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                        style="background-color: #fdfd96; color: #ff4500;">
                        Downpayment
                        <span>Rp{{ number_format($transaksi->downpayment_amount, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"
                        style="background-color: #ffe4b5; color: #4b0082;">
                        Sisa Pembayaran
                        <span>Rp{{ number_format($transaksi->remaining_payment, 0, ',', '.') }}</span>
                    </li>

                    <!-- Form untuk pelunasan -->
                    <div class="row mb-4">
                        <div class="col-md-3 font-weight-bold">Pelunasan:</div>
                        <div class="col-md-9">
                            <form action="{{ route('transaksi.pelunasan', $transaksi->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="pelunasan_amount" class="font-weight-bold text-dark">Jumlah
                                        Pelunasan</label>
                                    <input type="number" name="pelunasan_amount" id="pelunasan_amount" class="form-control"
                                        placeholder="Masukkan jumlah pelunasan" required>
                                </div>

                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary" type="submit">Bayar Pelunasan</button>
                                    @error('pelunasan_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </ul>


            <h5 class="font-weight-bold text-secondary mb-3 mt-4">Status Tracking</h5>
            @if ($transaksi->trackingStatuses->isEmpty())
                <p class="text-muted">Belum ada status tracking.</p>
            @else
                <ul class="list-group mb-3">
                    @foreach ($transaksi->trackingStatuses as $trackingStatus)
                        <li class="list-group-item d-flex justify-content-between align-items-center"
                            style="border-left: 5px solid #0056b3; margin-bottom: 10px; background-color: #f1f3f5; padding: 15px;">

                            <!-- Sebelah Kiri: Status -->
                            <div style="flex: 1;">
                                <strong class="text-primary" style="font-size: 1.1rem; color: #0056b3;">
                                    {{ $trackingStatus->status->name }}
                                </strong>
                            </div>

                            <!-- Tengah: Deskripsi -->
                            <div style="flex: 2; text-align: center;">
                                <span style="color: #343a40;">{{ $trackingStatus->description }}</span>
                            </div>

                            <!-- Kanan: Tanggal dan Jam dengan Ikon, disejajarkan vertikal -->
                            <div style="flex: 1; text-align: right; display: flex; flex-direction: column; align-items: flex-end;">
                                <!-- Tanggal Icon -->
                                <span title="Tanggal" style="margin-bottom: 5px; display: flex; align-items: center;">
                                    <i class="fas fa-calendar-alt" style="color: #2b0e5c; margin-right: 5px;"></i>
                                    <span style="color: #2b0e5c;">
                                        {{ \Carbon\Carbon::parse($trackingStatus->tanggal_status)->format('d-m-Y') }}
                                    </span>
                                </span>
                                <!-- Jam Icon, tanpa detik -->
                                <span title="Waktu" style="display: flex; align-items: center;">
                                    <i class="fas fa-clock" style="color: #2b0e5c; margin-right: 5px;"></i>
                                    <span style="color: #2b0e5c;">
                                        {{ \Carbon\Carbon::parse($trackingStatus->jam_status)->format('H:i') }}
                                    </span>
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="row mb-3">
                <div class="col-md-12">
                    @if ($transaksi->trackingStatuses->last()->status->name == 'Pending')
                        <a href="{{ route('transaksi.proses', $transaksi->uuid) }}" class="btn btn-primary">Ubah ke
                            Proses</a>
                    @elseif ($transaksi->trackingStatuses->last()->status->name == 'Proses')
                        <a href="{{ route('transaksi.finish', $transaksi->uuid) }}" class="btn btn-success">Ubah ke
                            Finish</a>
                        <a href="{{ route('transaksi.revisi', $transaksi->uuid) }}" class="btn btn-warning">Revisi ke
                            Status Sebelumnya</a>
                    @elseif ($transaksi->trackingStatuses->last()->status->name == 'Finish')
                        @if ($transaksi->status_pickup == 'not_picked_up')
                            <a href="{{ route('transaksi.revisi', $transaksi->uuid) }}" class="btn btn-warning">Revisi ke
                                Status Sebelumnya</a>
                        @endif
                    @else
                        <button class="btn btn-secondary" disabled>Status tidak dapat diubah</button>
                    @endif
                </div>
            </div>
<div id="copyText" style="display: none;">
Transaksi #{{ $transaksi->tracking_number }}
============================
Nama Customer    : {{ $transaksi->nama_customer }}
Nomor Telepon    : {{ $transaksi->notelp_customer }}
============================
Nama Admin       : {{ $transaksi->nama_admin_input }}
Total Harga      : Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}
Status Pembayaran : {{ ucfirst($transaksi->status) }}
============================
Tanggal Transaksi: {{ $transaksi->tanggal_transaksi }}
Jam Transaksi    : {{ $transaksi->jam_transaksi }}
Catatan          : {{ $transaksi->note }}
Status Pickup    : {{ $transaksi->status_pickup }}
============================
Status Tracking  : {{ $transaksi->trackingStatuses->last()->status->name ?? 'Tidak ada' }}
Deskripsi        : {{ $transaksi->trackingStatuses->last()->description ?? '' }}
Tanggal          : {{ $transaksi->trackingStatuses->last()->tanggal_status ?? '' }}
Jam              : {{ $transaksi->trackingStatuses->last()->jam_status ?? '' }}
</div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('transaksi.cetak_pdf', $transaksi->uuid) }}" target="_blank" class="btn btn-danger">Cetak
                    PDF</a>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                <button id="copyBtn" class="btn btn-info me-2">Copy Detail</button>
            </div>
            
        </div>
    </div>
    <script>
    document.getElementById('copyBtn').addEventListener('click', function () {
        const text = document.getElementById('copyText').innerText;

        navigator.clipboard.writeText(text).then(function () {
            alert('Detail transaksi berhasil disalin!');
        }, function (err) {
            alert('Gagal menyalin teks');
        });
    });
</script>

@endsection