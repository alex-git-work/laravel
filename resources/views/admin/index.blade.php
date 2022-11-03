@php

/**
 * @var Collection $articles
 */

use Illuminate\Database\Eloquent\Collection;
use App\Models\Article;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Главная')

@section('content')
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ ucfirst(strtolower(auth()->user()->name)) }}, добро пожаловать.</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Сейчас в блоге статей
                        <span class="badge badge-primary badge-pill">{{ $articles->count()}}</span>
                    </li>
                    <li class="list-group-item disabled d-flex justify-content-between align-items-center">
                        Из них:
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Опубликовано
                        <span class="badge badge-primary badge-pill badge-success">{{ $articles->where('status', '=', Article::STATUS_PUBLISHED)->count() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Скрыто
                        <span class="badge badge-primary badge-pill badge-danger">{{ $articles->where('status', '=', Article::STATUS_HIDDEN)->count() }}</span>
                    </li>
                </ul>
                <a class="btn btn-primary btn-sm float-left mt-4" href="{{ route('admin.article.index') }}">Редактировать</a>
                <a class="btn btn-success btn-sm float-right mt-4" href="{{ route('admin.article.create') }}">Написать</a>
            </div>
        </div>
    </div>
@endsection
