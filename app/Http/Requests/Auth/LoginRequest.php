<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string|digits:12',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Summary of messages
     * @return array{password.min: string, password.required: string, phone.digits: string, phone.required: string}
     */
    public function messages(): array
    {
        return [
            'phone.required' => "Telefon nomeri kiritiliwi sha'rt!",
            'phone.digits'   => "Telefon nomeri 12 xanali san boliwi kerek. (Misal: 998901234567)",
            'password.required' => 'Parol kiritilishi shart.',
            'password.min'      => 'Parol keminde 6 xanali boliwi kerek!',
        ];
    }
}
