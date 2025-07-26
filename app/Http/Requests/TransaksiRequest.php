<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pastikan ini true jika otorisasi tidak diperlukan
    }

    /**
     * Modify the data before validation.
     */
    protected function prepareForValidation()
    {
        $categorySepatu = $this->input('category_sepatu', []);

        foreach ($categorySepatu as &$sepatuData) {
            if (isset($sepatuData['plus_services'])) {
                // Filter `plus_services` untuk hanya menyertakan elemen yang memiliki 'id'
                $sepatuData['plus_services'] = array_filter($sepatuData['plus_services'], function ($service) {
                    return isset($service['id']);
                });
            }
        }

        // Gabungkan kembali data yang telah difilter ke dalam request
        $this->merge([
            'category_sepatu' => $categorySepatu,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_customer' => 'required|string|max:255',
            'notelp_customer' => 'required|string|max:15',
            'plus_services.*' => 'exists:plus_services,id', // Validasi layanan tambahan
            'promosi_kode' => 'nullable|string|exists:promosis,kode', // Kode promosi opsional
            'status' => 'required|in:downpayment,paid',

            // Validasi untuk `category_sepatu` dan `category_hargas`

            // Validasi untuk `plus_services`
            'category_sepatu.*.plus_services' => 'nullable|array',
            'category_sepatu.*.plus_services.*.id' => 'nullable|exists:plus_services,id',
            'category_sepatu.*.plus_services.*.category_sepatu_id' => 'nullable|exists:category_sepatus,id',

            'downpayment_amount' => 'nullable|numeric|min:0', // Validasi minimal downpayment
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'nama_customer.required' => 'Nama customer wajib diisi.',
            'email_customer.required' => 'Email customer wajib diisi.',
            'email_customer.email' => 'Format email tidak valid.',
            'notelp_customer.required' => 'Nomor telepon wajib diisi.',
            'alamat_customer.required' => 'Alamat wajib diisi.',
            'status.required' => 'Status pembayaran harus dipilih.',
            'downpayment_amount.numeric' => 'Jumlah downpayment harus berupa angka.',
            'downpayment_amount.min' => 'Jumlah downpayment tidak boleh kurang dari 0.',

            // Custom messages for category_sepatu and category_hargas


            // Custom messages for plus_services within each category_sepatu
            'category_sepatu.*.plus_services.*.id.exists' => 'Layanan tambahan yang dipilih tidak valid.',
            'category_sepatu.*.plus_services.*.category_sepatu_id.exists' => 'Kategori sepatu untuk layanan tambahan tidak valid.',

            // Custom messages for promosi_kode
            'promosi_kode.exists' => 'Kode promosi tidak valid.',
        ];
    }
}
