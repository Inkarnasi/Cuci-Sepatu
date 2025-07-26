<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePromosiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika otorisasi diperlukan
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string|exists:promosis,kode',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kode promosi wajib diisi.',
            'kode.exists' => 'Kode promosi tidak ditemukan.',
        ];
    }
}
