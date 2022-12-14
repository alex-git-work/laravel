@php

/**
 * @var string $title
 * @var News $news
 * @var Collection $comments
 */

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

@endphp

@extends('layout.master')

@section('jumbotron')
@endsection

@section('row')
    <div class="jumbotron alert alert-light border-top"></div>
@endsection

@section('title', $title = $news->title)

@section('content')
    <div class="col-md-8 blog-main">
        <h4 class="pb-3 mb-3 font-italic float-left">{{ $title }}</h4>
        <span class="text-muted mt-2 float-right">{{ $news->created_at->translatedFormat('j F Y') }}</span>
        <div class="clearfix border-bottom mb-4"></div>
        <p class="mb-5">{!! nl2br(e($news->body)) !!}</p>
        @include('layout.tags', ['tags' => $news->tags])
        <div class="clearfix mb-5">
            <a class="float-left" href="{{ route('index') }}"><- На главную</a>
            @admin
                <a class="float-right text-success" href="{{ route('admin.news.edit', ['news' => $news]) }}">Редактировать</a>
                <div class="clearfix mb-5"></div>
            @endadmin
        </div>

        @include('layout.comment.add-form', ['route' => route('news.comment', ['news' => $news])])

        @if($news->comments->isNotEmpty())
            @include('layout.comment.list', ['comments' => $comments])
            <br>
        @endif
    </div>
@endsection
