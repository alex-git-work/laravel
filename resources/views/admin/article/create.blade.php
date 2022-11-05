@extends('admin.layouts.master')

@section('title', $title = 'Создание статьи')

@section('content')
    <div class="col-sm-12 col-lg-8">
        <form method="post" action="{{ route('admin.article.store') }}">
            @csrf
            @include('forms.article')
        </form>
    </div>
@endsection
