@php

/**
 * @var string $title
 * @var Collection $articles
 * @var Article $article
 */

use Illuminate\Database\Eloquent\Collection;
use App\Models\Article;

@endphp

@extends('layout.master')

@section('title', $title = config('app.name'))

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }} - from the Firehose</h3>
    @if($articles->isNotEmpty())
        @foreach($articles as $article)
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
                <p class="blog-post-meta">{{ $article->created_at->translatedFormat('j F Y') }}</p>
                <p>{{ $article->preview }}</p>
                <br>
                <a href="{{ route('article.show', ['article' => $article->slug]) }}">Читать далее</a>
            </div><!-- /.blog-post -->
        @endforeach
    @else
        <p>Статей пока нет, но они скоро появятся.</p>
    @endif

    <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>
@endsection
