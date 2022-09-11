@php

/**
 * @var string $title
 * @var string $message
 */

use App\Http\Controllers\ArticleController;
use App\Models\Article;

@endphp

@extends('layout.master')

@section('title', $title = 'Добавление новой статьи')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
    @include('layout.flash-success')
    <form method="post" action="{{ route('article.store') }}">
        @csrf
        <div class="form-group">
            <span class="text-danger">*</span> <small class="text-muted">Все поля обязательны для заполнения</small>
        </div>
        <div class="form-group">
            <label for="title">Название страницы</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" aria-describedby="slugHelp" placeholder="Если оставить поле пустым, то slug будет сгенерирован автоматически">
            @error('slug')
            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
            @enderror
            <small id="slugHelp" class="form-text text-muted">должен быть уникальным, и должен состоять только из латинских букв, цифр, символов тире и подчеркивания</small>
        </div>
        <div class="form-group">
            <label for="preview">Краткое описание статьи</label>
            <textarea class="form-control @error('preview') is-invalid @enderror" id="preview" name="preview" rows="3">{{ old('preview') }}</textarea>
            @error('preview')
            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">Основной текст</label>
            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10">{{ old('body') }}</textarea>
            @error('body')
            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" id="status" name="status" value="{{ Article::STATUS_PUBLISHED }}" @checked(old('status'))>
                <label class="form-check-label" for="status">Опубликовано</label>
            </div>
            @error('status')
            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </form>
    <br>
@endsection
