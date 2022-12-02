@php

/**
 * @var Article $article
 */

use App\Models\Article;

$article = $article ?? new Article();

@endphp

<div class="mb-5">
    <a class="float-left" href="{{ route('index') }}"><- На главную</a>
    @admin
    <a class="float-right text-success" href="{{ route('admin.article.edit', ['article' => $article]) }}">Редактировать -></a>
    @endadmin
    @unlessadmin
    @can('update', $article)
        <a class="float-right text-success" href="{{ route('article.edit', ['article' => $article]) }}">Редактировать -></a>
    @endcan
    @endadmin
</div>
<div class="clearfix"></div>
