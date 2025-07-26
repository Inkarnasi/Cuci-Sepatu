<?php

namespace App\Http\Controllers;

use App\Models\advice;
use App\Models\Hadiah;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index()
{
    // Ambil tahun dari request, default ke tahun sekarang
    $year = request()->get('tahun', now()->year);

    // Ambil semua tahun yang tersedia dari data transaksi
    $availableYears = Transaksi::selectRaw('YEAR(tanggal_transaksi) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    // Hitung total transaksi
    $totalTransaksi = Transaksi::count();

    // Hitung jumlah transaksi dengan promosi
    $jumlahKodePromosiDigunakan = Transaksi::whereNotNull('promosi_id')->count();

    // Hitung total pembayaran yang sudah lunas
    $totalPaid = Transaksi::where('status', 'paid')->sum('total_harga');

    // Hitung total pembayaran tertunggak (outstanding)
    $totalOutstanding = Transaksi::where('status', 'downpayment')->sum('remaining_payment');

    // Ambil 3 kritik/saran terbaru
    $advice = Advice::select("nama", "advice")
        ->latest()
        ->take(3)
        ->get();

    // Hitung pendapatan per bulan untuk tahun yang dipilih
    $totalPendapatanPerBulan = [];
    for ($month = 1; $month <= 12; $month++) {
        $totalPendapatanPerBulan[] = Transaksi::whereMonth('tanggal_transaksi', $month)
            ->whereYear('tanggal_transaksi', $year)
            ->sum('total_harga');
    }

    // Hitung transaksi tanpa promosi
    $transaksiWithoutPromosi = $totalTransaksi - $jumlahKodePromosiDigunakan;

    // Data untuk chart promosi (pie/donut)
    $promosiData = [
        'Dengan Kode Promosi' => $jumlahKodePromosiDigunakan,
        'Tanpa Kode Promosi' => $transaksiWithoutPromosi
    ];

    return view('Dashboard.index', compact(
        'totalTransaksi',
        'jumlahKodePromosiDigunakan',
        'totalPaid',
        'totalOutstanding',
        'advice',
        'totalPendapatanPerBulan',
        'promosiData',
        'availableYears',
        'year'
    ));
}
public function monthlyReport(Request $request)
{
    $request->validate([
        'month' => 'required|numeric|between:1,12',
        'year' => 'required|numeric|digits:4'
    ]);

    $month = $request->input('month');
    $year = $request->input('year');

    // Ambil transaksi terlebih dahulu
    $transactions = transaksi::with([
        'categoryHargas1.category',
        'plusServices1.plusService',
        'trackingStatuses.status'
    ])->whereMonth('tanggal_transaksi', $month)
      ->whereYear('tanggal_transaksi', $year)
      ->orderByDesc('tanggal_transaksi')
      ->orderByDesc('jam_transaksi')
      ->get();

    // Hitung total transaksi setelah data tersedia
    $totalSemuaTransaksi = $transactions->sum('total_harga');

    if ($transactions->isEmpty()) {
        return back()->with('warning', 'Tidak ada transaksi untuk bulan dan tahun yang dipilih.');
    }

    $monthName = Carbon::createFromDate($year, $month, 1)->locale('id')->monthName;

    $data = [
        'month' => $monthName,
        'year' => $year,
        'transactions' => $transactions,
        'companyName' => 'SNEAKER CLEANS CLUB',
        'totalSemuaTransaksi' => $totalSemuaTransaksi,
    ];

    $pdf = PDF::loadView('Dashboard.monthly', $data)->setPaper('a4', 'landscape');

    return $pdf->download("laporan_bulanan_{$monthName}_{$year}.pdf");
}

}
