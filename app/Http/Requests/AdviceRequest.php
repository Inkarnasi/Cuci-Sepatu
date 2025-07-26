<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pastikan ini true jika otorisasi tidak diperlukan
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'advice' => 'required|string|min:10|max:5000',
            'tracking_number' => 'required|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'tracking_number.required' => 'Nota wajib diisi.',
            'advice.required' => 'Kritik/saran wajib diisi.',
            'advice.min' => 'Kritik/saran harus memiliki minimal 10 karakter.',
            'advice.max' => 'Kritik/saran tidak boleh lebih dari 5000 karakter.',
        ];
    }
}
