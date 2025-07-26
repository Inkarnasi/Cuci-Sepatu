@extends('Layouts_new.index')

<style>
    /* General Card Styling */
    .card {
        border-radius: 12px;
        border: 1px solid #e9ecef;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .form-control-plaintext {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
    }

    .btn-outline-secondary {
        display: inline-flex;
        align-items: center;
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 5px;
    }

    .btn-outline-secondary i {
        margin-right: 5px;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card-body {
            flex-direction: column;
            align-items: flex-start;
        }

        .d-flex.align-items-center img {
            width: 60px;
            height: 60px;
        }

        .card-body .ms-3 {
            margin-left: 0;
        }
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    /* Social Media Icons */
    .bi {
        margin-right: 8px;
    }

    .bi-twitter {
        color: #1DA1F2;
    }

    .bi-facebook {
        color: #1877F2;
    }

    .bi-instagram {
        color: #E1306C;
    }

    .bi-tiktok {
        color: #000000;
    }
</style>

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Profile</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container mt-1 mb-5">
        <h2 class="mb-4">Profiles</h2>

        <!-- Profile Section -->
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h4 class="mb-0">{{ $dataStore->name ?? '' }}</h4>
                        <p class="text-muted">{{ $dataStore->address ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Personal Information</h5>
                <a href="{{ route('store.edit-information', $dataStore->uuid) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-edit"></i> Edit Information
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Nama Profil</label>
                        <p class="form-control-plaintext">{{ $dataStore->name ?? '' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Email Profil</label>
                        <p class="form-control-plaintext">{{ $dataStore->email ?? '' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">No Telephone Profil</label>
                        <p class="form-control-plaintext">{{ $dataStore->phone ?? '' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Deskripsi Profil</label>
                        <p class="form-control-plaintext">{{ $dataStore->description ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Social Media</h5>
                <a href="{{ route('store.edit-social-media', $dataStore->uuid) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-edit"></i> Edit Social Media
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Twitter -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Twitter</label>
                        <p class="form-control-plaintext">
                            <a href="{{ $dataStore->twitter_url ?? '#' }}"
                                target="{{ $dataStore->twitter_url ? '_blank' : '' }}"
                                onclick="{{ $dataStore->twitter_url ? '' : 'showAlert(event)' }}">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                        </p>
                    </div>

                    <!-- Facebook -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Facebook</label>
                        <p class="form-control-plaintext">
                            <a href="{{ $dataStore->facebook_url ?? '#' }}"
                                target="{{ $dataStore->facebook_url ? '_blank' : '' }}"
                                onclick="{{ $dataStore->facebook_url ? '' : 'showAlert(event)' }}">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                        </p>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Instagram</label>
                        <p class="form-control-plaintext">
                            <a href="{{ $dataStore->instagram_url ?? '#' }}"
                                target="{{ $dataStore->instagram_url ? '_blank' : '' }}"
                                onclick="{{ $dataStore->instagram_url ? '' : 'showAlert(event)' }}">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                        </p>
                    </div>

                    <!-- Tiktok -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Tiktok</label>
                        <p class="form-control-plaintext">
                            <a href="{{ $dataStore->tiktok_url ?? '#' }}"
                                target="{{ $dataStore->tiktok_url ? '_blank' : '' }}"
                                onclick="{{ $dataStore->tiktok_url ? '' : 'showAlert(event)' }}">
                                <i class="bi bi-tiktok"></i> Tiktok
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showAlert(event) {
        event.preventDefault(); // Mencegah tautan default
        Swal.fire({
            icon: 'warning',
            title: 'URL Tidak Tersedia',
            text: 'Link untuk media sosial ini belum tersedia.',
            confirmButtonText: 'OK'
        });
    }
</script>
@endsection
