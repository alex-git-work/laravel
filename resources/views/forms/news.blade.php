@php

/**
 * @var string $message
 * @var News $news
 */

use App\Models\News;

$news = $news ?? new News();

@endphp

<div class="form-group">
    <span class="text-danger">*</span> <small class="text-muted">Все поля обязательны для заполнения</small>
</div>
<div class="form-group">
    <label for="title">Название</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $news->title) }}">
    @error('title')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Основной текст</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10">{{ old('body', $news->body) }}</textarea>
    @error('body')
    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Метки</label>
    <input type="text" class="form-control text-primary" id="tags" name="tags" value="{{ old('tags', $news->tags->pluck('name')->implode(',')) }}">
    <small id="slugHelp" class="form-text text-muted">метки вводятся через запятую</small>
</div>
<div class="form-group">
    <button class="btn btn-success float-left" type="submit">Сохранить</button>
    @if($news->id)
        <a class="btn btn-danger float-right" href="#" onclick="$('.news-destroy').trigger('submit')">Удалить</a>
    @endif
</div>
<div class="clearfix"></div>
