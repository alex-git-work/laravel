@php

/**
 * @var LengthAwarePaginator $articles
 * @var Article $article
 * @var bool $is_active
 */

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Article;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Не опубликованные статьи')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            @include('admin.layouts.article.grid')
        </div>
    </div>
@endsection
