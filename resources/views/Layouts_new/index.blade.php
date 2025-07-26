<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Admin Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <link href="{{ asset('assets/compiled/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/compiled/css/app-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/compiled/css/iconly.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/extensions/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/compiled/css/form-editor-summernote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        hr {
            border: none;
            border-top: 1px solid;
            opacity: 0.6;
            /* Transparansi untuk mengurangi kontras */
        }

        [data-bs-theme="light"] hr {
            border-color: #000 !important;
        }

        [data-bs-theme="dark"] hr {
            border-color: #ffffff !important;
        }

        .sidebar-brand {
            text-align: center;
            font-size: 24px;
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #000000;
            margin-top: 10px;
        }
        .brand-line {
    border: none;
    border-top: 1px solid #000; /* Warna garis */
    margin: 5px auto;
    width: 80%; /* Panjang garis */
    opacity: 0.6;
}


    </style>
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-brand">
                    Sneakers Clean Club
                </div>
                <hr class="brand-line">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none"
                            style="gap: 6px;">

                            <div <span style="display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0d6efd"
                                    class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 10c1.105 0 2 .672 2 1.5v.5H3v-.5c0-.828.895-1.5 2-1.5h6z" />
                                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd"
                                        d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                                </svg>
                                </span>
                                <span style="font-size: 16px; font-weight: 600; color: #0d6efd;">
                                    {{ auth()->user()->role == 'superadmin' ? 'Admin' : 'Karyawan' }}
                                </span>
                        </a>
                    </div>
                    <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                    opacity=".3"></path>
                                <g transform="translate(-210 -1)">
                                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                    <circle cx="220.5" cy="11.5" r="4"></circle>
                                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                style="cursor: pointer" />
                            <label class="form-check-label"></label>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                            </path>
                        </svg>
                    </div>
                    <div class="sidebar-toggler x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->role == 'superadmin')
                        <li
                            class="sidebar-item {{ request()->routeIs('promosi.index', 'promosi.create', 'promosi.edit', 'promosi.show') ? 'active' : '' }}">
                            <a href="{{ route('promosi.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Promosi</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item {{ request()->routeIs('kategori.index', 'kategori.create', 'kategori.show', 'kategori.edit') ? 'active' : '' }}">
                            <a href="{{ route('kategori.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item {{ request()->routeIs('plus-service.index', 'plus-service.create', 'plus-service.edit') ? 'active' : '' }}">
                            <a href="{{ route('plus-service.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Plus Service</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ request()->routeIs('transaksi.index', 'transaksi.create', 'transaksi.edit', 'transaksi.show') ? 'active' : '' }}">
                            <a href="{{route('transaksi.index')}}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                    @endif
                    @if (in_array(auth()->user()->role, ['karyawan', 'karyawan1', 'Karyawan2', 'karyawan3', 'karyawan4', 'karyawan5', 'karyawan6']));
                        <li class="sidebar-item">
                            <a href="{{route('transaksi.index')}}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="{{ route('promosi.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Promosi</span>
                            </a>
                        </li>
                    @endif



                    {{-- @dd(auth()->user()->role) --}}
                    @if (auth()->user()->role == 'superadmin')
                        <li
                            class="sidebar-item {{ request()->routeIs('user.index', 'user.create', 'user.edit') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('store.index') ? 'active' : '' }}">
                            <a href="{{ route('store.index') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Store</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item {{ request()->routeIs('logout') ? 'active' : '' }}">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main">
        @yield('breadcrumbs')
        <hr>
        @yield('content')

        {{-- <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>
                        Crafted with
                        <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="https://saugi.me">Saugi</a>
                    </p>
                </div>
            </div>
        </footer> --}}
    </div>
    </div>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/summernote.js') }}"></script>
</body>

</html>