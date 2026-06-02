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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            
            // --- SATPAM VALIDASI BARU ---
            'phone' => ['required', 'regex:/^0[0-9]{8,14}$/'], 
            'address' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'], // <--- UDAH DIUBAH
        ];
    }

    /**
     * Custom pesan error pakai bahasa manusia (Indonesia)
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Nomor telepon harus berupa angka dan wajib diawali dengan angka 0.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'postal_code.numeric' => 'Kode pos hanya boleh berisi angka.', // <--- UDAH DIUBAH
            'postal_code.required' => 'Kode pos wajib diisi.', // <--- UDAH DIUBAH
            'address.required' => 'Alamat lengkap wajib diisi.',
        ];
    }
}   