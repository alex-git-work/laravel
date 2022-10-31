@php

/**
 * @var string $title
 * @var Article $article
 */

use App\Models\Article;

@endphp

@extends('layout.master')

@section('title', $title = 'Редактирование статьи')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
        @include('layout.flash-success')
        <form method="post" action="{{ route('article.update', ['article' => $article]) }}">
            @csrf
            @method('PATCH')
            @include('forms.article')
        </form>
        <form id="article-destroy-form" method="post" action="{{ route('article.destroy', ['article' => $article]) }}">
            @csrf
            @method('DELETE')
        </form>
        <br>
    </div><!-- /.blog-main -->
@endsection
