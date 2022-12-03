@php

/**
 * @var string $title
 * @var Paginator $news
 * @var News $item
 */

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use App\Models\News;

@endphp

@extends('layout.master')

@section('jumbotron')
@endsection

@section('row')
    <div class="jumbotron alert alert-light border-top"></div>
@endsection

@section('title', $title = 'Новости')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
        @forelse($news as $item)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title float-left">{{ $item->title }}</h5>
                    <span class="text-muted float-right">{{ $item->created_at->translatedFormat('j F Y') }}</span>
                    <div class="clearfix"></div>
                    <hr>
                    <p>{{ Str::limit($item->body, 150) }}</p>
                    @include('layout.tags', ['tags' => $item->tags])
                    <a class="float-left" href="{{ route('news.show', ['news' => $item]) }}">читать далее</a>
                    @if($item->comments->count() > 0)
                        <span class="float-left">&nbsp;|&nbsp;</span>
                        <a class="float-left text-muted" href="{{ route('news.show', ['news' => $item]) . '#comments' }}">Комментарии</a>
                    @endif
                    @admin
                        <a class="float-right text-success" href="{{ route('admin.news.edit', ['news' => $item]) }}">Редактировать</a>
                    @endadmin
                    <div class="clearfix"></div>
                </div>
            </div>
        @empty
            <p>Новостей пока нет</p>
        @endforelse

        {{ $news->links() }}
    </div>
@endsection
