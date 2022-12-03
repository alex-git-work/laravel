@php

/**
 * @var string $title
 * @var Collection $articles
 * @var Collection $news
 * @var Article $article
 * @var News $item
 */

use App\Models\Article;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

@endphp

@extends('layout.master')

@section('title', $title = config('app.name'))

@section('content')
    <div class="col-md-8 blog-main mb-5">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }} - from the Firehose</h3>
        @forelse($articles as $article)
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
            </div>
        @empty
            <p>Статей с такой меткой нет</p>
        @endforelse

        @forelse($news as $item)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title float-left">{{ $item->title }}</h5>
                    <span class="text-muted float-right">{{ $item->created_at->translatedFormat('j F Y') }}</span>
                    <div class="clearfix"></div>
                    <hr>
                    <p>{{ Str::limit($item->body, 150) }}</p>
                    @include('layout.tags', ['tags' => $item->tags])
                    <a class="float-left" href="{{ route('news.show', ['news' => $item]) }}">читать далее</a>
                    @if($item->comments->count() > 0)
                        <span class="float-left">&nbsp;|&nbsp;</span>
                        <a class="float-left text-muted" href="{{ route('news.show', ['news' => $item]) . '#comments' }}">Комментарии</a>
                    @endif
                    @admin
                    <a class="float-right text-success" href="{{ route('admin.news.edit', ['news' => $item]) }}">Редактировать</a>
                    @endadmin
                    <div class="clearfix"></div>
                </div>
            </div>
        @empty
            <p>Новостей с такой меткой нет</p>
        @endforelse
    </div>
@endsection
