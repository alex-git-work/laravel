@php

/**
 * @var LengthAwarePaginator $articles
 * @var Article $article
 * @var bool $is_active
 */

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Article;

@endphp

<a class="btn btn-success btn-sm float-right" href="{{ route('admin.article.create') }}">Создать</a>
<div class="clear-both"></div>
<div class="row">
    <div class="col-xs-12 col-lg-12 col-xl-6">
        @if($articles->isNotEmpty())
            <table class="padding-md mb-4">
                <thead>
                <tr>
                    <th></th>
                    <th><p><b>Название статьи</b></p></th>
                    <th><p><b>Slug</b></p></th>
                    <th><p><b>Дата создания</b></p></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
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
                            @if($is_active)
                                <div class="float-left">
                                    <form method="post" action="{{ route('admin.article.toggle', ['article' => $article]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input name="status" type="hidden" value="<?= Article::STATUS_HIDDEN ?>">
                                        <button onclick="return confirm('Вы уверены?');" class="btn btn-outline-dark btn-xs" type="submit" name="toggle">Скрыть</button>
                                    </form>
                                </div>
                                @if($article->history->isNotEmpty())
                                    <div class="float-left">
                                        <a class="btn btn-outline-info btn-xs ml-1" href="{{ route('admin.article.history', ['article' => $article]) }}">История</a>
                                    </div>
                                @endif
                            @else
                                <div class="float-left">
                                    <form method="post" action="{{ route('admin.article.toggle', ['article' => $article]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input name="status" type="hidden" value="<?= Article::STATUS_PUBLISHED ?>">
                                        <button onclick="return confirm('Вы уверены?');" class="btn btn-outline-success btn-xs" type="submit" name="toggle">Опубликовать</button>
                                    </form>
                                </div>
                                <div class="float-left">
                                    <form method="post" action="{{ route('admin.article.destroy', ['article' => $article]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Вы уверены? Это действие отменить нельзя!');" class="btn btn-outline-danger btn-xs ml-1" type="submit" name="delete">Удалить</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $articles->onEachSide(config('pagination.admin_section.each_side'))->links() }}
        @else
            <p>Статей пока нет.</p>
        @endif
    </div>
</div>
