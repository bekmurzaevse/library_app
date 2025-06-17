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
            'user_id' => 'required|integer',
            'book_id' => 'required|integer|exists:books,id',
            // 'status' => 'nullable|string',
            // 'booking_date' => 'required|date_format:Y-m-d',
            // 'return_date' => 'required|date_format:Y-m-d',
        ];
    }
}
