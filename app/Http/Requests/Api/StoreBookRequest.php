<?php

namespace App\Http\Requests\Api;

use App\Enums\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreBookRequest extends FormRequest
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
            'title'             => ['required', 'string', 'max:255'],
            'publisher'         => ['required', 'string', 'max:100'],
            'author'            => ['required', 'string', 'max:100'],
            'genre'             => ['required', new Enum(Genre::class)],
            'publication_date'  => ['required', 'date_format:Y-m-d'],
            'words_number'      => ['required', 'integer', 'min:0'],
            'price'             => ['required', 'numeric', 'between:0.01,99999999.99'],
        ];
    }
}
