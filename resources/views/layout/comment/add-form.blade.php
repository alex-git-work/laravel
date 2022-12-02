@php

/**
* @var string $type
* @var int $id
*/

@endphp

@guest
    <div class="card">
        <h5 class="card-header">Написать комментарий</h5>
        <div class="card-body">
            <p class="card-text">Только зарегистрированные пользователи могут оставлять комментарии</p>
            @if (Route::has('login'))
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Войти</a>
            @endif
        </div>
    </div>
@else
    @include('layout.flash-success')
    <form action="{{ route('comment.store') }}" method="post">
        @csrf
        <div class="card">
            <h5 class="card-header">Написать комментарий</h5>
            <div class="card-body">
                <label class="control-label text-muted" for="body">поле обязательно для заполнения</label>
                <p>
                    <textarea id="body" name="body" class="form-control form-control-md mb-4 @error('body') is-invalid @enderror" rows="5"></textarea>
                </p>
                <input type="hidden" name="commentable_type" value="{{ $type }}">
                <input type="hidden" name="commentable_id" value="{{ $id }}">
                @error('body')
                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
                <button class="btn btn-success" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
@endguest
