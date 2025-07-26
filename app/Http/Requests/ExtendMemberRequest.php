<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtendMemberRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Pastikan otorisasi diizinkan
    }

    public function rules()
    {
        return [
            'kode' => 'required|string|max:255',
            'buktiPembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'kelas_membership' => 'required|in:standard,gold,premium',
            'totalPembayaran' => 'required|numeric|min:0',
        ];
    }
}
