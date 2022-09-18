<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreMessageRequest
 * @package App\Http\Requests
 */
class StoreMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'max:64'],
            'body' => ['required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле Email обязательно для заполнения',
            'email.max' => 'Длина Email не должна превышать 64 символа',
            'body.required' => 'Поле Сообщение обязательно для заполнения'
        ];
    }
}
