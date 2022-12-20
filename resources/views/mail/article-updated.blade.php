@php

/**
 * @var Article $article
 */

use App\Models\Article;

$url = route('article.show', ['slug' => $article->slug]);
@endphp

<x-mail::message>
# Обновлена статья: {{ $article->title }}

{{ $article->updated_at->translatedFormat('j F Y') }}

<x-mail::button :url="$url" color="success">
Посмотреть
</x-mail::button>

Рассылка от<br>
{{ config('app.name') }}
</x-mail::message>
