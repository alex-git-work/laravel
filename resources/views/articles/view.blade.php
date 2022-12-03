@php

/**
 * @var string $title
 * @var Article $article
 * @var Comment $comment
 */

use App\Models\Article;
use App\Models\Comment;

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
            @include('layout.tags', ['tags' => $article->tags])

            @include('layout.article.links', ['article' => $article])

            @include('layout.comment.add-form', ['type' => Article::MORPH_TYPE, 'id' => $article->id])

            @if($article->comments->count() > 0)
                @include('layout.comment.list', ['comments' => $article->comments()->orderBy('created_at', 'desc')->get()])
                @include('layout.article.links', ['article' => $article])
                <br>
            @endif
        </div>
    </div><!-- /.blog-main -->
@endsection
