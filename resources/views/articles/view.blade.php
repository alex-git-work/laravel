@php

/**
 * @var string $title
 * @var Article $article
 */

use App\Models\Article;

@endphp

@extends('layout.master')

@section('title', $article->title)

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->translatedFormat('j F Y') }}</p>
            <p>{{ $article->preview }}</p>
            <hr>
            <p>{!! nl2br($article->body) !!}</p>
            @include('layout.tags', ['article' => $article])
            <a class="float-left" href="{{ route('index') }}"><- На главную</a>
            @admin
            <a class="float-right text-success" href="{{ route('admin.article.edit', ['article' => $article]) }}">Редактировать -></a>
            @endadmin
            @unlessadmin
                @can('update', $article)
                    <a class="float-right text-success" href="{{ route('article.edit', ['article' => $article]) }}">Редактировать -></a>
                @endcan
            @endadmin
        </div>
    </div><!-- /.blog-main -->
@endsection
