@php

/**
 * @var string $title
 * @var Article $article
 * @var Collection $comments
 * @var Comment $comment
 */

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

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

            @include('layout.comment.add-form', ['route' => route('article.comment', ['article' => $article])])

            @if($article->comments->isNotEmpty())
                @include('layout.comment.list', ['comments' => $comments])
                @include('layout.article.links', ['article' => $article])
                <br>
            @endif
        </div>
    </div><!-- /.blog-main -->
@endsection
