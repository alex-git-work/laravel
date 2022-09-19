@php

/**
 * @var string $message
 * @var Article $article
 */

use App\Models\Article;

$article = $article ?? new Article();

@endphp

<div class="form-group">
    <span class="text-danger">*</span> <small class="text-muted">Все поля обязательны для заполнения</small>
</div>
<div class="form-group">
    <label for="title">Название страницы</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title) }}">
    @error('title')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $article->slug) ?? Str::slug(old('title')) }}" aria-describedby="slugHelp" placeholder="Если оставить поле пустым, то slug будет сгенерирован автоматически">
    @error('slug')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
    <small id="slugHelp" class="form-text text-muted">должен быть уникальным, и должен состоять только из латинских букв, цифр, символов тире и подчеркивания</small>
</div>
<div class="form-group">
    <label for="preview">Краткое описание статьи</label>
    <textarea class="form-control @error('preview') is-invalid @enderror" id="preview" name="preview" rows="3">{{ old('preview', $article->preview) }}</textarea>
    @error('preview')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Основной текст</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10">{{ old('body', $article->body) }}</textarea>
    @error('body')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Метки</label>
    <input type="text" class="form-control text-primary" id="tags" name="tags" value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}">
    <small id="slugHelp" class="form-text text-muted">метки вводятся через запятую</small>
</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" id="status" name="status" value="{{ Article::STATUS_PUBLISHED }}" @checked(old('status', $article->status))>
        <label class="form-check-label" for="status">Опубликовано</label>
    </div>
    @error('status')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <button class="btn btn-success float-left" type="submit">Сохранить</button>
    @if($article->id)
        <a class="btn btn-danger float-right" href="#" onclick="$('#article-destroy-form').trigger('submit')">Удалить</a>
    @endif
</div>
<div class="clearfix"></div>
