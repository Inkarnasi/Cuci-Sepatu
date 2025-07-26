<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan hanya superadmin yang dapat membuat kategori
        return auth()->user()->role === 'superadmin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_kategori' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
            'estimation' => 'required|integer',
            'parent_id' => 'exists:categories,id',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'description.required' => 'Deskripsi kategori wajib diisi.',
            'estimation.integer' => 'Estimasi harus berupa angka.',
            'parent_id.exists' => 'ID kategori induk tidak ditemukan.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.required' => 'Harga wajib diisi.',
            'estimation.required' => 'Estimasi wajib diisi.',
        ];
    }
}
