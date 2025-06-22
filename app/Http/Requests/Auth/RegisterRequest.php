<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|digits:12|unique:users,phone',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Summary of messages
     * @return array{first_name.required: string, first_name.string: string, last_name.required: string, last_name.string: string, password.min: string, password.required: string, phone.digits: string, phone.required: string}
     */
    public function messages(): array
    {
        return [
            'first_name.required' => "Ati kiritiliwi sha'rt!",
            'first_name.string' => "Ati tekst boliwi kerek!",
            'last_name.required' => "Familiya kiritiliwi sha'rt!",
            'last_name.string' => "Familiya tekst boliwi kerek!",
            'phone.required' => "Telefon nomeri kiritiliwi sha'rt!",
            'phone.unique' => "Bunday telefon nomeri bazada bar!",
            'phone.digits'   => "Telefon nomeri 12 xanali san boliwi kerek. (Misal: 998901234567)",
            'password.required' => 'Parol kiritilishi shart.',
            'password.min'      => 'Parol keminde 6 xanali boliwi kerek!',
        ];
    }

}
