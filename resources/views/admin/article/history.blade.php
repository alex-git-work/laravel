@php

/**
 * @var string $title
 * @var Article $article
 * @var ArticleHistory $row
 */

use App\Models\Article;
use App\Models\ArticleHistory;

@endphp

@extends('admin.layouts.master')

@section('title', $title = $article->title)

@section('content')
    <div class="row w-100">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">История изменений</h5>
                    @forelse($article->history as $row)
                        <div class="card-body">
                            <p>
                                Пользователь <b>{{$article->user->name}}</b> {{ $row->created_at->translatedFormat('j F Y') }}
                                в <b>{{ $row->created_at->translatedFormat('H:i:s') }}</b> внёс следующие изменения:
                            </p>
                            <p class="text-danger">Было:</p>
                            @foreach($row->old as $field => $value)
                                <p><b>{{ $field }}</b> - <span class="text-muted">{!! nl2br(e($value)) !!}</span></p>
                            @endforeach
                            <p class="text-success">Стало:</p>
                            @foreach($row->current as $field => $value)
                                <p><b>{{ $field }}</b> - <span class="text-muted">{!! nl2br(e($value)) !!}</span></p>
                            @endforeach
                            <hr>
                        </div>
                    @empty
                        <p>Изменений статьи не было</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
