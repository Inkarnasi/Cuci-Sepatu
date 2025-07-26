@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
        </div>
        @if (session('error'))
            <div class="alert alert-light-danger alert-dismissible fade show" style="height: 50px" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-light-success alert-dismissible fade show" style="height: 50px" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                @if (auth()->user()->role == 'superadmin')
                    <a href="{{ url('/dashboard/kategori/create') }}" class="btn btn-primary" style="margin-right: 5px;">Tambah
                        Kategori</a>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="periodeTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Sub Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            var dataMaster = $('#periodeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kategori.list') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'treatment_type',
                    name: 'treatment_type'
                },
                {
                    data: 'uuid',
                    name: 'uuid',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `
                        <a href="/dashboard/kategori/subkategori/${data}" class="btn icon btn-sm btn-info">
                            <i class="bi bi-plus"></i>
                        </a>
                        <a href="/dashboard/kategori/showsub/${data}" class="btn icon btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    `;
                    }
                },
                {
                    data: 'uuid',
                    name: 'uuid',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        let actionButtons = `
                                <a href="/dashboard/kategori/show/${data}" class="btn icon btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            `;

                        @if (auth()->user()->role == 'superadmin')
                            actionButtons += `
                                    <a href="/dashboard/kategori/edit/${data}" class="btn icon btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>`;
                        @endif

                                return actionButtons;
                    }
                }
                ],
                autoWidth: false,
                drawCallback: function (settings) {
                    $('a').tooltip();
                }
            });
        });

    </script>
@endsection