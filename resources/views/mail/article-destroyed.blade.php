@php

/**
 * @var Article $article
 */

use App\Models\Article;

@endphp

<x-mail::message>
# Удалена статья: {{ $article->title }}

Статью удалил пользователь с ником <b>{{ $article->user->name }}</b>

Рассылка от<br>
{{ config('app.name') }}
</x-mail::message>
