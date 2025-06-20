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
            'title' => 'required|string|unique:books,title',
            'author' => 'required|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'available_copies' => 'required|integer',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'title.required' => 'Kitob nomi kiritilishi shart.',
    //         'title.unique' => 'Bu nomdagi kitob bazada mavjud.',
    //         'author.required' => 'Muallif ismini kiritish shart.',
    //         'cover_image.image' => 'Rasm noto‘g‘ri formatda.',
    //         'available_copies.required' => 'Nusxa soni ko‘rsatilishi kerak.',
    //         'available_copies.integer' => 'Nusxa soni butun son bo‘lishi kerak.',
    //     ];
    // }


}
