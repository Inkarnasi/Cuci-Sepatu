<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateMembershipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|exists:members,kode',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kode membership wajib diisi.',
            'kode.exists' => 'Kode membership tidak ditemukan.',
        ];
    }
}
