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
            @include('layout.tags', ['article' => $article])
            @include('layout.article-links', ['article' => $article])
            @guest
                <div class="card">
                    <h5 class="card-header">Написать комментарий</h5>
                    <div class="card-body">
                        <p class="card-text">Только зарегистрированные пользователи могут оставлять комментарии</p>
                        @if (Route::has('login'))
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">Войти</a>
                        @endif
                    </div>
                </div>
            @else
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <h5 class="card-header">Написать комментарий</h5>
                        <div class="card-body">
                            <label class="control-label text-muted" for="comment-body">поле обязательно для заполнения</label>
                            <p><textarea id="comment-body" name="comment-body" class="form-control form-control-md mb-4" rows="5"></textarea></p>
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </div>
                </form>
            @endguest
            @if($article->comments->isNotEmpty())
                <h3 class="blog-post-title mb-4 mt-5" id="comments">Комментарии</h3>
                @foreach($article->comments as $comment)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title float-left">{{ $comment->user->name }}</h5>
                            <span class="text-muted float-right">{{ $comment->created_at->translatedFormat('j F Y') }}</span>
                            <div class="clearfix"></div>
                            <hr>
                            <p>{{ $comment->body }}</p>
                        </div>
                    </div>
                @endforeach
                @include('layout.article-links', ['article' => $article])
            @endif
        </div>
    </div><!-- /.blog-main -->
@endsection
