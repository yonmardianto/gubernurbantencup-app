<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'file' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
            'club' => ['required'],
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'club.required' => 'Club wajib diisi',
            'file.required' => 'Bukti pembayaran wajib diupload',
            'file.max' => 'File bukti pembayaran maximum size 1MB',
            'file.mimes' => 'Bukti pembayaran harus berupa file JPG, JPEG, atau PNG',
            'description.required' => 'Deskripsi wajib diisi',
            'description.max' => 'Panjang deskripsi tidak boleh melebihi 255 karakter',
        ];
    }
}
