<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        @foreach(config('main-menu', [['route' => 'index', 'title' => 'Главная']]) as $item)
            <a class="p-2 text-muted" href="{{ route($item['route']) }}">{{ $item['title'] }}</a>
        @endforeach
    </nav>
</div>
