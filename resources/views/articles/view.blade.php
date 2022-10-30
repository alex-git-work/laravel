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
            <p>{{ $article->body }}</p>
            @include('layout.tags', ['article' => $article])
            <a href="{{ route('index') }}"><- На главную</a>
        </div>
    </div><!-- /.blog-main -->
@endsection
