@php

/**
 * @var string $title
 */

@endphp

@extends('layout.master')

@section('title', $title = 'Добавление новой статьи')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
        @include('layout.flash-success')
        <form method="post" action="{{ route('article.store') }}">
            @csrf
            @include('forms.article')
        </form>
        <br>
    </div><!-- /.blog-main -->
@endsection
