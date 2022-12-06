<?php

namespace App\Http\Requests;

use App\Models\Traits\HasGetTags;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreNewsRequest
 * @package App\Http\Requests
 */
class StoreNewsRequest extends FormRequest
{
    use HasGetTags;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'between:5,150'],
            'body' => ['required', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Поле Название обязательно для заполнения',
            'title.string' => 'Поле должно быть строкой',
            'title.between' => 'Поле Название должно быть не менее 5 и не более 150 символов',
            'body.required' => 'Поле Текст обязательно для заполнения',
            'body.string' => 'Поле должно быть строкой',
        ];
    }
}
