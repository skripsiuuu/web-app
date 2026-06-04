<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            
            // --- SATPAM VALIDASI NOMOR HP INDO SUPER KETAT ---
            'phone' => ['required', 'regex:/^08[1-9][0-9]{7,10}$/'], 
            'address' => ['required', 'string'],
            'postal_code' => ['required', 'numeric', 'digits:5'],
        ];
    }

    /**
     * Custom pesan error pakai bahasa manusia (Indonesia)
     */
    public function messages(): array
    {
        return [
            // Pesan error untuk Nama dan Email
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',

            // Pesan error untuk Telepon, Alamat, dan Kode Pos
            'phone.required' => 'Nomor handphone wajib diisi.',
            'phone.regex' => 'Nomor tidak valid. Wajib berupa nomor handphone Indonesia (diawali 08) dengan panjang 10-13 digit.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'postal_code.required' => 'Kode pos wajib diisi.',
            'postal_code.numeric' => 'Kode pos hanya boleh berisi angka.',
            'postal_code.digits' => 'Kode pos harus tepat berisi 5 digit angka.',
        ];
    }
}