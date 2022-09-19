@php

/**
 * @var Article $article
 * @var Tag $tag
 */

use App\Models\Article;
use App\Models\Tag;

$article = $article ?? new Article();

@endphp

@if($article->tags->isNotEmpty())
    <hr>
    <div>
        <span class="text-muted">Метки:</span>
        @foreach($article->tags as $tag)
            <a class="badge badge-secondary text-white" href="{{ route('tag.index', ['tag' => $tag]) }}">{{ $tag->name }}</a>
        @endforeach
    </div>
    <br>
@endif
