<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use App\Models\Category; // Untuk mengambil data kategori

class TransaksiEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi;
    public function __construct(Transaksi $transaksi)
    {
        // Muat transaksi dengan semua relasi yang diperlukan
        $this->transaksi = $transaksi->load(['categoryHargas', 'plusServices', 'trackingStatuses.status', 'promosi', 'member.tracks']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Ambil semua kategori dari database untuk diberikan ke view PDF
        $categories = Category::all();

        // Logika untuk mendapatkan diskon member (menggunakan eager loading)
        $memberDiscount = 0;
        if ($this->transaksi->member && $this->transaksi->member->tracks->isNotEmpty()) {
            $memberTrack = $this->transaksi->member->tracks->first(); // Ambil track terbaru
            $memberDiscount = $memberTrack ? $memberTrack->discount : 0;
        }

        // Generate PDF menggunakan view 'transaksi.cetak_pdf' dengan semua data yang dibutuhkan
        $pdf = PDF::loadView('transaksi.cetak_pdf', [
            'transaksi' => $this->transaksi,
            'categories' => $categories,
            'memberDiscount' => $memberDiscount,
        ]);

        return $this->subject('Transaksi Berhasil - ' . $this->transaksi->tracking_number)
            ->view('emails.transaksi') // View email yang akan ditampilkan
            ->attachData($pdf->output(), 'transaksi_' . $this->transaksi->tracking_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);

   
}
}
