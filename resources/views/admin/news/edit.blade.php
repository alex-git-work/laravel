@php

/**
 * @var string $title
 * @var News $news
 */

use App\Models\News;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Редактирование новости')

@section('content')
    <div class="col-sm-12 col-lg-8">
        <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}">
            @csrf
            @method('PATCH')
            @include('forms.news')
        </form>
        <form class="news-destroy" method="post" action="{{ route('admin.news.destroy', ['news' => $news]) }}">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
