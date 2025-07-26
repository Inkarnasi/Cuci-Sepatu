@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Daftar Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Membership</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Membership untuk {{ $member->nama_membership }}</h6>
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
            <h5 class="font-weight-bold text-secondary mb-3">Informasi Membership</h5>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nama Lengkap:</div>
                <div class="col-md-9">{{ $member->nama_membership }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Email:</div>
                <div class="col-md-9">{{ $member->email_membership }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nomor Telepon:</div>
                <div class="col-md-9">{{ $member->phone_membership }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Alamat:</div>
                <div class="col-md-9">{{ $member->alamat_membership }}</div>
            </div>

            <h5 class="font-weight-bold text-secondary mb-3 mt-4">
                Detail Membership Track
                <button class="btn btn-link p-0" type="button" id="toggleMembershipTrack">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>

            <div id="membershipTrackSection" class="collapse-section">
                @foreach ($membersTrack as $index => $track)
                    <div class="mb-3">
                        <!-- Tampilkan status dengan styling -->
                        <h5 class="mt-3 mb-1 font-weight-bold text-primary">Track #{{ $index + 1 }}</h5>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">Status:</div>
                            <div class="col-md-9">{{ $track->status }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">Kelas Membership:</div>
                            <div class="col-md-9">{{ $track->kelas_membership }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">Bukti Pembayaran:</div>
                            <div class="col-md-9">
                                <img src="{{ asset('storage/' . $track->buktiPembayaran) }}" alt="Bukti Pembayaran"
                                    class="img-fluid" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            @if ($member->kode)
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Kode Member:</div>
                    <div class="col-md-9">
                        <span class="badge bg-info">{{ $member->kode }}</span>
                    </div>
                </div>
            @endif

            @php
                // Ambil status terakhir dari memberTrack1
                $lastStatus = $memberTrack1 ? $memberTrack1->status : null;

                // Filter untuk mengecek apakah status 'active' atau 'expired' tidak ada dalam list status yang terakhir
                $filteredMembersTrack = $membersTrack->filter(function ($track) {
                    return !in_array($track->status, ['active', 'expired']);
                });
            @endphp

            @if ($filteredMembersTrack->isNotEmpty() && !in_array($lastStatus, ['active', 'expired']))
                <!-- Check if none have 'active' or 'expired' status -->
                <h5 class="font-weight-bold text-secondary mb-3 mt-4">Verifikasi Membership</h5>
                <form action="{{ route('memberships.verify', $member->uuid) }}" method="POST" id="verifyMembershipForm">
                    @csrf
                    <button type="submit" class="btn btn-primary">Verifikasi Membership</button>
                </form>
            @endif


            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Script untuk toggle collapsible section
        document.getElementById('toggleMembershipTrack').addEventListener('click', function() {
            var section = document.getElementById('membershipTrackSection');
            if (section.style.display === "none" || section.style.display === "") {
                section.style.display = "block"; // Tampilkan section
            } else {
                section.style.display = "none"; // Sembunyikan section
            }
        });
    </script>
    <script>
        document.getElementById('verifyMembershipForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit form default

            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan memverifikasi membership ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, verifikasi sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, kirim form
                    this.submit();
                }
            });
        });
    </script>
@endsection
