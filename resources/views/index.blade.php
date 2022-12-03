@php

/**
 * @var string $title
 * @var Paginator $articles
 * @var Article $article
 */

use App\Models\Article;
use Illuminate\Pagination\Paginator;

@endphp

@extends('layout.master')

@section('title', $title = config('app.name'))

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }} - from the Firehose</h3>
        @include('layout.flash-success')
        @if($articles->isNotEmpty())
            @foreach($articles as $article)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                    <p class="blog-post-meta">{{ $article->created_at->translatedFormat('j F Y') }}</p>
                    <p>{{ $article->preview }}</p>
                    @include('layout.tags', ['tags' => $article->tags])
                    <a class="float-left" href="{{ route('article.show', ['article' => $article]) }}">Читать далее</a>
                    @if($article->comments->count() > 0)
                        <span class="float-left">&nbsp;|&nbsp;</span>
                        <a class="float-left text-muted" href="{{ route('article.show', ['article' => $article]) . '#comments' }}">Комментарии</a>
                    @endif
                    @can('update', $article)
                        <a class="float-right text-success" href="{{ route('article.edit', ['article' => $article]) }}">Редактировать</a>
                    @endcan
                    <br>
                </div><!-- /.blog-post -->
            @endforeach
        @else
            <p>Статей пока нет, но они скоро появятся.</p>
        @endif

        {{ $articles->links() }}
    </div><!-- /.blog-main -->
@endsection
