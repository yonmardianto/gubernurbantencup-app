<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club' => [
                'required',
                'string',
                'max:255',
                // Unique across users.club, but IGNORE the current user's own club
                Rule::unique(User::class, 'club')->ignore($this->user()->id),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'club' => 'Nama Club',
        ];
    }

    public function messages(): array
    {
        return [
            'club.unique' => 'Nama club tersebut sudah digunakan oleh tim lain.',
        ];
    }
}