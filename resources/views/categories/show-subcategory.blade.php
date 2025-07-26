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
            <!-- Informasi Kategori Induk -->
            <h5 class="font-weight-bold text-secondary mb-3">Informasi Kategori</h5>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Nama Kategori:</div>
                <div class="col-md-9">{{ $category1->treatment_type }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Deskripsi:</div>
                <div class="col-md-9">
                    @if (!empty($category1->description))
                        {{ $category1->description }}
                    @else
                        <span class="text-muted">Tidak ada deskripsi tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Informasi Sub-Kategori (Jika Ada) -->
            @if ($category->isNotEmpty())
                <h5 class="font-weight-bold text-secondary mb-3">Sub-Kategori</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Sub-Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Estimasi (Hari)</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $subKriteria)
                                    <tr id="row-{{ $subKriteria->uuid }}">
                                        <td>{{ $subKriteria->nama_kategori }}</td>
                                        <td>{{ $subKriteria->description }}</td>
                                        <td>Rp{{ number_format($subKriteria->price, 0, ',', '.') }}</td>
                                        <td>{{ $subKriteria->estimation }}</td>
                                        <td>{{ $subKriteria->status_kategori }}</td>
                                        <td>
                                            @if ($subKriteria->status_kategori === 'active')
                                                <a href="{{ route('kategori.deactivate', $subKriteria->uuid) }}"
                                                    class="btn btn-warning btn-sm" title="Nonaktifkan">
                                                    <i class="fas fa-lock"></i> <!-- Icon for deactivating (lock) -->
                                                </a>
                                            @else
                                                <a href="{{ route('kategori.activate', $subKriteria->uuid) }}"
                                                    class="btn btn-success btn-sm" title="Aktifkan">
                                                    <i class="fas fa-unlock"></i> <!-- Icon for activating (unlock) -->
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                <a href="{{ route('kategori.edit', $category1->uuid) }}" class="btn btn-primary mr-2">Edit</a>
            
                <form id="delete-form-{{ $category1->uuid }}" action="{{ route('kategori.destroy', $category1->uuid) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $category1->uuid }}">
                        Hapus
                    </button>
                </form>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const uuid = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Kategori ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + uuid).submit();
                        }
                    });
                });
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var uuid = this.getAttribute('data-uuid');
                    var rowId = this.getAttribute('data-row-id'); // Ambil id baris untuk dihapus

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Sub-Kategori akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/dashboard/kategori/delete-subkategori/${uuid}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        _method: 'DELETE'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Berhasil!', `${data.message}`,
                                                'success')
                                            .then(() => {
                                                // Hapus baris dari DOM setelah sukses
                                                document.getElementById(rowId)
                                                    .remove();
                                            });
                                    } else {
                                        Swal.fire('Error!', data.message, 'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error!',
                                        'Terjadi kesalahan saat menghapus sub-kategori.',
                                        'error');
                                });
                        }
                    });
                });
            });
        });
    </script>

@endsection
