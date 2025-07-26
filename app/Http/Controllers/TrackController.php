<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Carbon\Carbon;
use App\Http\Requests\TrackingRequest;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function tracking(TrackingRequest $request)
    {
        // Ambil trackingCode dari request
        $trackingCode = $request->input('trackingCode');

        // Cek apakah ada transaksi yang cocok dengan tracking number
        $transaksi = Transaksi::with(['trackingStatuses.status']) // Ambil relasi dengan trackingStatuses
            ->where('tracking_number', $trackingCode) // Cocokkan dengan tracking_number
            ->first();

        // Jika tidak ada transaksi, kembalikan pesan error dalam bentuk JSON
        if (!$transaksi) {
            return response()->json([
                'error' => 'Kode pesanan '. $trackingCode. ' tidak ditemukan. Pastikan Anda memasukkan kode yang benar.'
            ], 404); // Kode HTTP 404 untuk not found
        }
        

        if($transaksi->status_pickup == 'picked_up'){
            return response()->json([
                'error' => 'Kode Pesanan ' . $trackingCode. ' Pesanan ini sudah diambil.'
            ], 404); // Kode HTTP 404 untuk not found
        }

        // Kembalikan data transaksi dan status tracking dalam bentuk JSON
        return response()->json([
            'tracking_number' => $transaksi->tracking_number,
            'statuses' => $transaksi->trackingStatuses->map(function ($status) {
                return [
                    'status_name' => $status->status->name,
                    'description' => $status->description,
                    'date' => Carbon::parse($status->tanggal_status)->format('d-m-Y'), // Pastikan tanggal diformat dengan Carbon
                    'time' => Carbon::parse($status->jam_status)->format('H:i') // Pastikan waktu diformat dengan Carbon
                ];
            })
        ], 200); // Kode HTTP 200 untuk success
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
