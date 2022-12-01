@php

/**
 * @var LengthAwarePaginator $news
 * @var News $item
 */

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Новости')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            <a class="btn btn-success btn-sm float-right" href="{{ route('admin.news.create') }}">Создать</a>
            <div class="clear-both"></div>
            <div class="row">
                <div class="col-12">
                    @if($news->isNotEmpty())
                        <table class="padding-md mb-4">
                            <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th><p><b>Название</b></p></th>
                                <th><p><b>Дата создания</b></p></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>
                                        <p>{{ $item->id }}</p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('admin.news.edit', ['news' => $item]) }}">{{ $item->title }}</a></p>
                                    </td>
                                    <td>
                                        <p>{{ $item->created_at }}</p>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin.news.destroy', ['news' => $item]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-xs float-right ml-1" type="submit" name="delete" onclick="return confirm('Вы уверены? Это действие отменить нельзя!');">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $news->onEachSide(config('pagination.admin_section.each_side'))->links() }}
                    @else
                        <p>Новостей пока нет</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
