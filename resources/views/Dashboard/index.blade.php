@extends('Layouts_new.index')

@section('content')
    <style>
        /* #wheelContainer {
                                                                        display: inline-block;
                                                                        position: relative;
                                                                        width: 300px;
                                                                        height: 300px;
                                                                    } */

        #wheelContainer {
            display: flex;
            /* Gunakan flexbox untuk menempatkan konten di tengah */
            justify-content: center;
            /* Pastikan roda berada di tengah secara horizontal */
            align-items: center;
            /* Pastikan roda berada di tengah secara vertikal */
            width: 100%;
            height: 300px;
            position: relative;
        }


        #wheel {
            width: 300px;
            height: 300px;
            display: inline-block;
            position: relative;
            transform-origin: center center;
            /* Pastikan roda berputar dari titik tengah */
            margin: 0 auto;
            /* Agar roda tetap berada di tengah */
            /* Pastikan roda diatur sebagai elemen relatif */
        }

        #pointer {
            position: absolute;
            top: -10px;
            /* Menyesuaikan agar pointer tetap berada di atas roda */
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            /* Mengecilkan lebar sisi kiri */
            border-right: 10px solid transparent;
            /* Mengecilkan lebar sisi kanan */
            border-top: 25px solid red;
            /* Mengecilkan tinggi pointer */
        }
    </style>

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldChart"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Transaksi</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalTransaksi }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldDiscount"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Kode Promosi Digunakan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $jumlahKodePromosiDigunakan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon orange mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Pembayaran Tertunggak</h6>
                                        <h6 class="font-extrabold mb-0">{{ number_format($totalOutstanding) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldBuy"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Pendapatan</h6>
                                        <h6 class="font-extrabold mb-0">{{ number_format($totalPaid) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Transaksi</h4>
                                <form action="{{ route('reports.monthly') }}" method="GET">
    <select name="month" required>
        @for($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                {{ Carbon\Carbon::create()->month($i)->locale('id')->monthName }}
            </option>
        @endfor
    </select>
    
    <select name="year" required>
        @for($i = now()->year - 2; $i <= now()->year + 2; $i++)
            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>
    
    <button type="submit">Generate PDF</button>
</form>
                                <select id="filter-tahun" class="form-select" style="width: auto;">
                                    @foreach ($availableYears as $th)
                                        <option value="{{ $th }}" {{ $th == $year ? 'selected' : '' }}>{{ $th }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    {{-- <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width: 10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width: 10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                style="width: 10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Saran/Kritik Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Saran/kritik</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($advice as $comment)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <!-- Placeholder image if needed -->
                                                                <img src="{{ asset('assets/compiled/jpg/8.jpg') }}"
                                                                    alt="people 1" />
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">{{ $comment->nama }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="mb-0">{{ $comment->advice }}</p>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">No advice available.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Face 1" />
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="text-muted mb-0">{{ Auth::user()->role }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        <h4>Recent Messages</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="./assets/compiled/jpg/4.jpg" />
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Hank Schrader</h5>
                                <h6 class="text-muted mb-0">@johnducky</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="./assets/compiled/jpg/5.jpg" />
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Dean Winchester</h5>
                                <h6 class="text-muted mb-0">@imdean</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="./assets/compiled/jpg/1.jpg" />
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">John Dodol</h5>
                                <h6 class="text-muted mb-0">@dodoljohn</h6>
                            </div>
                        </div>
                        <div class="px-4">
                            <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                                Start Conversation
                            </button>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Promo</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="easing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/spin-wheel@5.0.2/dist/spin-wheel-iife.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.getElementById("filter-tahun").addEventListener("change", function () {
            const selectedYear = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('tahun', selectedYear);
            window.location.href = url.toString();
        });

        // Pastikan tidak ada syntax error dan posisi variabel sudah benar
        // Function to format numbers to Rupiah
        function formatRupiah(amount) {
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            });
            return formatter.format(amount);
        }

        var totalPendapatanPerBulan = {!! json_encode($totalPendapatanPerBulan) !!};

        // Format each value to Rupiah
        var totalPendapatanFormatted = totalPendapatanPerBulan.map(formatRupiah);

        // Now you can use totalPendapatanFormatted for your chart or display
        // console.log(totalPendapatanFormatted);
        // console.log(totalPendapatanPerBulan); // Cek apakah data sudah benar

        var totalPromosi = {!! json_encode($promosiData) !!};
        console.log(totalPromosi);
    </script>
@endsection