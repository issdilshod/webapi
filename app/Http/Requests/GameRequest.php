<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'genres' => 'nullable|array',
            'developers' => 'nullable|array'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'genres' => 'Жанры',
            'developers' => 'Разработчики'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute обязательное поле.'
        ];

    }
}
