@extends('admin.layouts.master')

@section('title', $title = 'Создание новости')

@section('content')
    <div class="col-sm-12 col-lg-8">
        <form method="post" action="{{ route('admin.news.store') }}">
            @csrf
            @include('forms.news')
        </form>
    </div>
@endsection
