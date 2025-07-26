<?php

namespace App\Http\Controllers;

use App\Models\advice;
use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Http\Requests\AdviceRequest;
use Illuminate\Support\Facades\Validator;

class AdviceController extends Controller
{

    public function postAdvice(AdviceRequest $request)
    {
        // Periksa apakah request adalah AJAX
        if ($request->ajax()) {
            $trackingExists = Transaksi::where('tracking_number', $request->tracking_number)->exists();

            if (!$trackingExists) {
                return response()->json([
                    'message' => 'Nomor Nota tidak ditemukan dalam data transaksi kami.'
                ], 404);
            }
            // Validasi berhasil dilakukan oleh AdviceRequest, sekarang simpan data
            $advice = new Advice();
            $advice->nama = $request->nama;
            $advice->no_telpon = $request->email;
            $advice->advice = $request->advice;
            $advice->tracking_number = $request->tracking_number;
            $advice->save();

            return response()->json([
                'message' => 'Terima kasih telah memberikan Saran/kritik kepada kami. Kritik/Saran Anda dapat berkontribusi terhadap pelayanan kami.'
            ], 200);
        }

        // Jika bukan request AJAX, kembalikan respons Method Not Allowed
        return response()->json(['message' => 'Method not allowed'], 405);
    }


    /**
     * Display a listing of the resource.
     */
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
