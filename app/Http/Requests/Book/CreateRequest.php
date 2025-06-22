<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'title' => 'required|string|unique:books,title',
            'author' => 'required|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'available_copies' => 'required|integer',
        ];
    }

    /**
     * Summary of messages
     * @return array{author.required: string, available_copies.integer: string, available_copies.required: string, cover_image.image: string, title.required: string, title.unique: string}
     */
    public function messages(): array
    {
        return [
            'title.required' => "Kita'p tin' ati kiritiliwi sha'rt",
            'title.unique' => "Bunday kita'p tin' ati bazada bar!",
            'author.required' => "Avtor kiritiliw sha'rt!",
            'cover_image.image' => "Foto tipinde mag'liwmat kiritiliwi kerek!",
            'available_copies.required' => "Kitap tin' sani kiritiliw sha'rt!",
            'available_copies.integer' => "Kita'ptin' sani pu'tin san boliwi kerek!",
        ];
    }


}
