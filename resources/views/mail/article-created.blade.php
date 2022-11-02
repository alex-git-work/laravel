@php

/**
 * @var Article $article
 */

use App\Models\Article;

$url = route('article.show', ['article' => $article]);
@endphp

<x-mail::message>
# Создана новая статья: {{ $article->title }}

{{ $article->created_at->translatedFormat('j F Y') }}

<x-mail::button :url="$url" color="success">
Прочитать
</x-mail::button>

Рассылка от<br>
{{ config('app.name') }}
</x-mail::message>
