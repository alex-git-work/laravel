@php

/**
 * @var string $title
 * @var News $news
 * @var Comment $comment
 */

use App\Models\Comment;
use App\Models\News;

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
        @admin
            <a class="float-left text-success border-top pt-3" href="{{ route('admin.news.edit', ['news' => $news]) }}">Редактировать</a>
            <div class="clearfix"></div>
        @endadmin
        @forelse($news->comments as $comment)
            {{ $comment->body }}<br><br>
        @empty
        @endforelse
    </div>
@endsection
