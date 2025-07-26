<?php

namespace App\Http\Controllers;

use App\Models\promosi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\PromosiRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Promosi.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $dataPromosi = promosi::select("uuid", "nama_promosi", "start_date", "end_date", "status", "kode")->get();
            // dd($dataPromosi);
            return DataTables::of($dataPromosi)
                ->addIndexColumn()
                ->make(true);
        }
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role != 'superadmin') {
            // Redirect pengguna non-superadmin ke halaman lain, misalnya ke halaman daftar promosi
            return redirect()->route('promosi.index')->with('error', 'Anda tidak memiliki akses untuk membuat promosi.');
        }

        return view('Promosi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromosiRequest $request)
    {
        if (auth()->user()->role != 'superadmin') {
            // Redirect pengguna non-superadmin ke halaman lain, misalnya ke halaman daftar promosi
            return redirect()->route('promosi.index')->with('error', 'Anda tidak memiliki akses untuk membuat promosi.');
        }

        // Cek apakah ada promosi lain dengan rentang tanggal yang persis sama
        $existingPromosiExact = promosi::where('start_date', $request->start_date)
            ->where('end_date', $request->end_date)
            ->first();

        if ($existingPromosiExact) {
            return redirect()->back()->withErrors(['error' => 'Promosi dengan rentang tanggal tersebut sudah ada.']);
        }

        $cekkode = promosi::where('kode', $request->kode)->first();

        if ($cekkode) {
            return redirect()->back()->withErrors(['error' => 'Promosi dengan kode tersebut sudah ada.']);
        }

        $existingPromosi = promosi::where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                ->orWhere(function ($query) use ($request) {
                    $query->where('start_date', '<=', $request->start_date)
                        ->where('end_date', '>=', $request->end_date);
                });
        })->first();

        if ($existingPromosi) {
            return redirect()->back()->withErrors(['error' => 'Rentang tanggal promosi sudah ada, harap memilih rentang tanggal yang berbeda.']);
        }

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/promosi/' . $imageName; // Simpan path relatif gambar
            $image->move(public_path('images/promosi'), $imageName);
        } else {
            $imagePath = null; // Jika tidak ada gambar, biarkan null
        }
        // Konversi diskon dari persentase ke desimal
        $discountInDecimal = $request->discount / 100;

        // Tentukan status promosi berdasarkan tanggal mulai dan berakhir
        $today = now()->toDateString(); // Mengambil tanggal hari ini (tanpa jam)

        // Konversi start_date dan end_date dari string menjadi objek Carbon
        $startDate = Carbon::parse($request->start_date)->toDateString();
        $endDate = Carbon::parse($request->end_date)->toDateString();

        if ($startDate > $today) {
            $status = 'upcoming';
        } elseif ($startDate <= $today && $endDate >= $today) {
            $status = 'active';
        } else {
            $status = 'expired';
        }

        promosi::create([
            'nama_promosi' => $request->nama_promosi,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'kode' => $request->kode,
            'status' => $status,
            'discount' => $discountInDecimal,
            'image' => $imagePath,
            'description' => $request->description,
            'minimum_payment' => $request->minimum_payment,
            'terms_conditions' => $request->terms_conditions,
        ]);

        return redirect()->route('promosi.index')->with('success', 'Promosi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $promosi = promosi::where('uuid', $uuid)->firstOrFail();
        return view('Promosi.show', compact('promosi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        if (auth()->user()->role != 'superadmin') {
            // Redirect pengguna non-superadmin ke halaman lain, misalnya ke halaman daftar promosi
            return redirect()->route('promosi.index')->with('error', 'Anda tidak memiliki akses untuk mengubah promosi.');
        }
        $promosi = promosi::where('uuid', $uuid)->firstOrFail();
        // dd($promosi);
        return view('Promosi.edit', compact('promosi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PromosiRequest $request, string $uuid)
    {
        if (auth()->user()->role != 'superadmin') {
            return redirect()->route('promosi.index')->with('error', 'Anda tidak memiliki akses untuk mengubah promosi.');
        }

        DB::beginTransaction(); // Mulai transaksi

        try {
            $promosi = promosi::where('uuid', $uuid)->firstOrFail();

            $existingPromosiExact = promosi::where('start_date', $request->start_date)
                ->where('end_date', $request->end_date)
                ->where('id', '!=', $promosi->id)
                ->first();
            // dd($existingPromosiExact);

            if ($existingPromosiExact) {
                return redirect()->back()->withErrors(['error' => 'Promosi dengan rentang tanggal tersebut sudah ada.']);
            }

            $cekkode = promosi::where('kode', $request->kode)->where('id', '!=', $promosi->id)->first();
            if ($cekkode) {
                return redirect()->back()->withErrors(['error' => 'Promosi dengan kode tersebut sudah ada.']);
            }

            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

            // dd($startDate, $endDate);

            $existingStartDate = Carbon::parse($promosi->start_date)->format('Y-m-d');
            $existingEndDate = Carbon::parse($promosi->end_date)->format('Y-m-d');

            // Cek apakah ada perubahan pada tanggal start atau end
            $datesChanged = ($existingStartDate !== $startDate || $existingEndDate !== $endDate);


            if ($datesChanged) {
                // Jika tanggal diubah, lakukan pengecekan tumpang tindih
                $existingPromosi = Promosi::where(function ($query) use ($startDate, $endDate) {
                    $query->where(function ($query) use ($startDate, $endDate) {
                        // Cek apakah rentang tanggal baru bertumpang tindih dengan rentang tanggal promosi lain
                        $query->where('start_date', '<=', $endDate) // Start date dari promosi yang ada <= end date baru
                            ->where('end_date', '>=', $startDate); // End date dari promosi yang ada >= start date baru
                    });
                    // dd($query->toSql());

                })
                    ->where('uuid', '!=', $promosi->uuid) // Pastikan untuk mengecualikan promosi yang sedang di-update
                    ->first();

                // Jika ada promosi lain yang tumpang tindih, tampilkan error
                if ($existingPromosi) {
                    return redirect()->back()->withErrors(['error' => 'Rentang tanggal promosi sudah ada, harap memilih rentang tanggal yang berbeda.']);
                }
            }

            // Jika ada file gambar baru yang diunggah
            if ($request->hasFile('image')) {
                if (!empty($promosi->image) && file_exists(public_path($promosi->image))) {
                    unlink(public_path($promosi->image)); // Hapus gambar lama
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/promosi/' . $imageName; // Path gambar baru
                $image->move(public_path('images/promosi'), $imageName);
            } else {
                $imagePath = $promosi->image; // Jika tidak ada gambar baru
            }

            $discountInDecimal = $request->discount / 100;

            // Tentukan status promosi berdasarkan tanggal
            $today = now()->toDateString(); // Mengambil tanggal hari ini (tanpa jam)

            // Konversi start_date dan end_date dari string menjadi objek Carbon
            $startDate = Carbon::parse($request->start_date)->toDateString();
            $endDate = Carbon::parse($request->end_date)->toDateString();

            if ($startDate > $today) {
                $status = 'upcoming';
            } elseif ($startDate <= $today && $endDate >= $today) {
                $status = 'active';
            } else {
                $status = 'expired';
            }


            // Update data promosi
            $promosi->update([
                'nama_promosi' => $request->nama_promosi,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'kode' => $request->kode,
                'discount' => $discountInDecimal,
                'status' => $status,
                'image' => $imagePath,
                'description' => $request->description,
                'minimum_payment' => $request->minimum_payment,
                'terms_conditions' => $request->terms_conditions,
            ]);

            DB::commit(); // Commit transaksi jika semua berjalan baik

            return redirect()->route('promosi.index')->with('success', 'Promosi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui promosi.'])->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        // Periksa apakah pengguna memiliki peran superadmin
        if (auth()->user()->role != 'superadmin') {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki akses untuk menghapus promosi.'], 403);
        }

        // Memulai transaksi database
        DB::beginTransaction();

        try {
            // Temukan promosi berdasarkan UUID
            $promosi = promosi::where('uuid', $uuid)->firstOrFail();

            // Hapus gambar dari folder jika ada
            if ($promosi->image && file_exists(public_path('images/promosi/' . $promosi->image))) {
                unlink(public_path('images/promosi/' . $promosi->image));
            }

            // Hapus data promosi dari database
            $promosi->delete();

            // Commit transaksi setelah operasi berhasil
            DB::commit();

            // Kembalikan respons JSON yang berhasil
            return response()->json(['success' => true, 'message' => 'Promosi berhasil dihapus.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Rollback transaksi jika data tidak ditemukan
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Promosi tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan lain
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus promosi.'], 500);
        }
    }
}
