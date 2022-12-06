@extends('admin.layouts.master')

@section('title', 'Отчёты')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            <p class="mb-5">В данный момент доступен только один отчёт.</p>
            <a class="btn btn-primary" href="{{ route('admin.report.total') }}">Итого</a>
        </div>
    </div>
@endsection
