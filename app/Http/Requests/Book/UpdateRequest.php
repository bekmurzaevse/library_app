<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'sometimes|string|unique:books,title',
            'author' => 'sometimes|string',
            'description' => 'sometimes|string',
            'cover_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'available_copies' => 'sometimes|integer',
        ];
    }

    /**
     * Summary of messages
     * @return array{author.required: string, available_copies.integer: string, available_copies.required: string, cover_image.image: string, title.required: string, title.unique: string}
     */
    public function messages(): array
    {
        return [
            'title.unique' => "Bunday kita'p tin' ati bazada bar!",
            'cover_image.image' => "Foto tipinde mag'liwmat kiritiliwi kerek!",
            'available_copies.integer' => "Kita'ptin' sani pu'tin san boliwi kerek!",
        ];
    }
}
