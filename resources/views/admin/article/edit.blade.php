@php

/**
 * @var string $title
 * @var Article $article
 */

use App\Models\Article;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Редактирование статьи')

@section('content')
    <div class="col-sm-12 col-lg-8">
        <form method="post" action="{{ route('admin.article.update', ['article' => $article]) }}">
            @csrf
            @method('PATCH')
            @include('forms.article')
        </form>
        <form id="article-destroy-form" method="post" action="{{ route('admin.article.destroy', ['article' => $article]) }}">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
