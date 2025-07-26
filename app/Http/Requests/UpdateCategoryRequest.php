<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan hanya superadmin yang dapat memperbarui kategori
        return auth()->user()->role === 'superadmin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'treatment_type' => 'required|string',
            'description' => 'required|string',
            'category.*.nama_kategori' => 'required|string',
            'category.*.price' => 'required|numeric',
            'category.*.estimation' => 'required|integer',
        ];
    }
    
    public function messages(): array
    {
        return [
            'description.required' => 'Deskripsi kategori wajib diisi.',
            'category.*.nama_kategori.required' => 'Nama sub-kategori wajib diisi.',
            'category.*.price.numeric' => 'Harga sub-kategori harus berupa angka.',
            'category.*.estimation.integer' => 'Estimasi sub-kategori harus berupa angka.',
        ];
    }
    
}
