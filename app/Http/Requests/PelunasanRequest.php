<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelunasanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelunasan_amount' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'pelunasan_amount.required' => 'Jumlah pelunasan harus diisi.',
            'pelunasan_amount.numeric' => 'Jumlah pelunasan harus berupa angka.',
            'pelunasan_amount.min' => 'Jumlah pelunasan tidak boleh kurang dari 0.',
        ];
    }
}
