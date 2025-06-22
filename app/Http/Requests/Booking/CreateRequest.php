<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
        ];
    }

    /**
     * Summary of messages
     * @return array{book_id.exists: string, book_id.integer: string, book_id.required: string}
     */
    public function messages(): array
    {
        return [
            'book_id.required' => "Kita'p id kiritiliwi sha'rt",
            'book_id.integer' => "Kita'p id pu'tin san boliwi kerek!",
            'book_id.exists' => "Kita'p id bazada tabilmadi!",
        ];
    }
}
