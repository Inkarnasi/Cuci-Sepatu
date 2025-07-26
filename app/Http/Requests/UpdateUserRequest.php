<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('uuid'); // Mengambil UUID dari route

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId . ',uuid', // Mengabaikan email yang sama dengan user saat ini
            'password' => 'nullable|min:8',
            'role' => 'required|string|in:superadmin,karyawan',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan pengguna lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Peran pengguna harus dipilih.',
        ];
    }
}
