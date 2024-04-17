<?php

namespace App\Http\Requests\Api;

use App\Enums\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'             => ['sometimes', 'required', 'string', 'max:255'],
            'publisher'         => ['sometimes', 'required', 'string', 'max:100'],
            'author'            => ['sometimes', 'required', 'string', 'max:100'],
            'genre'             => ['sometimes', 'required', new Enum(Genre::class)],
            'publication_date'  => ['sometimes', 'required', 'date_format:Y-m-d'],
            'words_number'      => ['sometimes', 'required', 'integer', 'min:0'],
            'price'             => ['sometimes', 'required', 'numeric', 'between:0.01,99999999.99'],
        ];
    }
}
