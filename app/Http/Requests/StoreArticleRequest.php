<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class StoreArticleRequest
 * @package App\Http\Requests
 */
class StoreArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        /** @var Article|null $article */
        $article = $this->route('article');

        $rules = [
            'title' => ['required', 'string', 'between:5,100'],
            'status' => [Rule::in(Article::STATUSES)],
            'preview' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:' . Article::class . ',slug', 'regex:/^[a-z0-9]+(?:[_-][a-z0-9]+)*$/'],
        ];

        if ($this->hasNoSlug()) {
            $rules['slug'] = ['unique:' . Article::class . ',slug'];
        }

        // Если при редактировании статьи slug не меняли
        if ($article !== null && $article->slug === $this->input('slug')) {
            Arr::forget($rules, 'slug');
        }

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Поле Название страницы обязательно для заполнения',
            'title.string' => 'Поле должно быть строкой',
            'title.between' => 'Поле Название страницы должно быть не менее 5 и не более 100 символов',
            'status.in' => 'Недопустимое значение статуса',
            'preview.required' => 'Поле Краткое описание статьи обязательно для заполнения',
            'preview.string' => 'Поле должно быть строкой',
            'preview.max' => 'Длина описания не должна превышать 255 символов',
            'body.required' => 'Поле Основной текст обязательно для заполнения',
            'body.string' => 'Поле должно быть строкой',
            'slug.required' => 'Поле slug обязательно для заполнения',
            'slug.string' => 'Поле должно быть строкой',
            'slug.unique' => 'Такой slug уже занят',
            'slug.regex' => 'Введенное значение не соответствует условиям',
        ];
    }

    /**
     * @param bool $asArray
     * @return array|Collection
     */
    public function getTags(bool $asArray = false): array|Collection
    {
        if ($this->input('tags') === null) {
            return $asArray ? [] : collect();
        }

        $tags = Arr::map(explode(',', $this->input('tags')), fn ($value) => trim($value));

        return $asArray ? $tags : collect($tags);
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareForValidation(): void
    {
        if ($this->hasNoSlug()) {
            $this->merge(['slug' => Str::slug($this->input('title'))]);
        }
    }

    /**
     * @return bool
     */
    protected function hasNoSlug(): bool
    {
        return $this->input('slug') === null;
    }
}
