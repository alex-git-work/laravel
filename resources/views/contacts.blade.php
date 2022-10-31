@php

/**
 * @var string $title
 * @var string $message
 */

use App\Http\Controllers\MessageController;

@endphp

@extends('layout.master')

@section('title', $title = 'Обратная связь')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
        @include('layout.flash-success')
        <form action="{{ route('contacts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <span class="text-danger">*</span> <small class="text-muted">Все поля обязательны для заполнения</small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
                @error('email')
                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
                <small id="emailHelp" class="form-text text-muted">Мы не поделимся вашей электронной почтой с кем-либо еще.</small>
            </div>
            <div class="form-group">
                <label for="body">Сообщение</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="4">{{ old('body') }}</textarea>
                @error('body')
                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div><!-- /.blog-main -->
@endsection
