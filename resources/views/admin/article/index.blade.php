@php

/**
 * @var Collection $articles
 * @var Article $article
 */

use Illuminate\Database\Eloquent\Collection;
use App\Models\Article;

@endphp

@extends('admin.layouts.master')

@section('title', $title = 'Статьи')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            <a class="btn btn-success btn-sm float-right" href="{{ route('admin.article.create') }}">Создать</a>
            <div class="clear-both"></div>
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-6">
                    <h4>Опубликованные</h4>
                    @if($articles->where('status', '=', Article::STATUS_PUBLISHED)->count() > 0)
                        <table class="padding-md">
                            <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th><p><b>Название страницы</b></p></th>
                                <th><p><b>Slug</b></p></th>
                                <th><p><b>Создана</b></p></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles->where('status', '=', Article::STATUS_PUBLISHED) as $article)
                                <tr>
                                    <td>
                                        <p>{{ $article->id }}</p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('admin.article.edit', ['article' => $article]) }}">{{ $article->title }}</a></p>
                                    </td>
                                    <td>
                                        <p>/{{ $article->slug }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $article->created_at }}</p>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin.article.toggle', ['article' => $article]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input name="status" type="hidden" value="<?= Article::STATUS_HIDDEN ?>">
                                            <button onclick="return confirm('Вы уверены?');" class="btn btn-outline-dark btn-xs float-right" type="submit" name="toggle">Скрыть</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Страниц пока нет.</p>
                    @endif
                </div>
                <div class="col-xs-12 col-lg-12 col-xl-6">
                    <h4>Скрытые</h4>
                    @if ($articles->where('status', '=', Article::STATUS_HIDDEN)->count() > 0)
                        <table class="padding-md">
                            <thead>
                            <tr>
                                <th></th>
                                <th><p><b>Название страницы</b></p></th>
                                <th><p><b>Slug</b></p></th>
                                <th><p><b>Создана</b></p></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles->where('status', '=', Article::STATUS_HIDDEN) as $article)
                                <tr>
                                    <td>
                                        <p>{{ $article->id }}</p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('admin.article.edit', ['article' => $article]) }}">{{ $article->title }}</a></p>
                                    </td>
                                    <td>
                                        <p>/{{ $article->slug }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $article->created_at }}</p>
                                    </td>
                                    <td>
                                        <div class="float-left">
                                            <form method="post" action="{{ route('admin.article.toggle', ['article' => $article]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input name="status" type="hidden" value="<?= Article::STATUS_PUBLISHED ?>">
                                                <button onclick="return confirm('Вы уверены?');" class="btn btn-outline-success btn-xs float-right" type="submit" name="toggle">Опубликовать</button>
                                            </form>
                                        </div>
                                        <div class="float-left">
                                            <form method="post" action="{{ route('admin.article.destroy', ['article' => $article]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Вы уверены? Это действие отменить нельзя!');" class="btn btn-outline-danger btn-xs float-right ml-1" type="submit" name="delete">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Страниц нет.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
