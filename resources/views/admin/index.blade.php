@php

/**
 * @var array $articlesQty
 * @var Article $maxArticleLength
 * @var Article $mimArticleLength
 * @var Article $historyMax
 * @var Article $commentsMax
 * @var int $news
 * @var User $maxArticlesUser
 * @var int $articlesAvg
 */

use App\Models\Article;
use App\Models\User;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Главная')

@section('content')
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ ucfirst(strtolower(auth()->user()->name)) }}, добро пожаловать.</h4>
                <h5 class="mb-3">Статьи</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Общее количество статей
                        <span class="badge badge-primary badge-pill">{{ $articlesQty['total'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center pl-5">
                        Опубликовано
                        <span class="badge badge-pill badge-success">{{ $articlesQty['published'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center pl-5">
                        Скрыто
                        <span class="badge badge-pill badge-danger">{{ $articlesQty['hidden'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Самая длинная статья
                        <span>
                            <a href="{{ route('article.show', ['article' => $maxArticleLength]) }}" class="mr-2">{{ $maxArticleLength->title }}</a>
                            <span class="mr-2">кол-во знаков:</span>
                            <span class="badge badge-pill badge-info">{{ $maxArticleLength->length }}</span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Самая короткая статья
                        <span>
                            <a href="{{ route('article.show', ['article' => $mimArticleLength]) }}" class="mr-2">{{ $mimArticleLength->title }}</a>
                            <span class="mr-2">кол-во знаков:</span>
                            <span class="badge badge-pill badge-info">{{ $mimArticleLength->length }}</span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Самая непостоянная статья
                        <span>
                            <a href="{{ route('article.show', ['article' => $historyMax]) }}" class="mr-2">{{ $historyMax->title }}</a>
                            <span class="mr-2">изменений:</span>
                            <span class="badge badge-pill badge-info">{{ $historyMax->history_count }}</span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Самая обсуждаемая статья
                        <span>
                            <a href="{{ route('article.show', ['article' => $commentsMax]) }}" class="mr-2">{{ $commentsMax->title }}</a>
                            <span class="mr-2">комментариев:</span>
                            <span class="badge badge-pill badge-info">{{ $commentsMax->comments_count }}</span>
                        </span>
                    </li>
                </ul>
                <a class="btn btn-primary btn-sm float-left" href="{{ route('admin.article.index') }}">Редактировать</a>
                <a class="btn btn-success btn-sm float-right" href="{{ route('admin.article.create') }}">Написать</a>
                <div class="clearfix mb-5"></div>
                <h5 class="mb-3">Новости</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Общее количество новостей
                        <span class="badge badge-primary badge-pill">{{ $news }}</span>
                    </li>
                </ul>
                <a class="btn btn-outline-primary btn-sm float-left" href="{{ route('admin.news.index') }}">Редактировать</a>
                <a class="btn btn-outline-success btn-sm float-right" href="{{ route('admin.news.create') }}">Написать</a>
                <div class="clearfix mb-5"></div>
                <h5 class="mb-3">Пользователи</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Автор, у которого больше всего статей
                        <span>
                            <b class="mr-2">{{ $maxArticlesUser->name }}</b>
                            <span class="mr-2">статей:</span>
                            <span class="badge badge-primary badge-pill">{{ $maxArticlesUser->articles_count }}</span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Средние количество статей у активных пользователей
                        <span class="badge badge-primary badge-pill">{{ $articlesAvg }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
