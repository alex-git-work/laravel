<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link pl-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        <span class="text-muted font-weight-lighter ml-2 ">admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? '' }}</a>
                <span class="text-muted text-sm">{{ auth()->user()->role->name ?? '' }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">Главное меню</li>
                @foreach(config('admin-menu', [['route' => 'admin.index', 'title' => 'Главная', 'icon' => 'fa fa-home']]) as $item)
                    <li class="nav-item">
                        <a href="{{ route($item['route']) }}" class="nav-link{{ request()->routeIs($item['route'])  ? ' active' : '' }}">
                            <i class="nav-icon {{ $item['icon'] }}"></i>
                            <p>{{ $item['title'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
