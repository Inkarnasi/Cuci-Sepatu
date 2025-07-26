<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromosiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pastikan otorisasi diatur dengan benar jika diperlukan
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_promosi' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'kode' => 'required|string',
            'discount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'minimum_payment' => 'nullable|numeric',
            'terms_conditions' => 'nullable|string',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages()
    {
        return [
            'nama_promosi.required' => 'Nama promosi wajib diisi.',
            'start_date.required' => 'Tanggal mulai promosi wajib diisi.',
            'end_date.required' => 'Tanggal berakhir promosi wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
            'kode.required' => 'Kode promosi wajib diisi.',
            'discount.required' => 'Diskon promosi wajib diisi.',
        ];
    }
}
