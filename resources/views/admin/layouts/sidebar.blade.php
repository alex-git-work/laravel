@php

/**
 * @var array $menu
 */

@endphp
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
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">Главное меню</li>
                @foreach($menu as $key => $item)
                    @if($item['route'] === '#')
                        @foreach($item['submenu'] as $element)
                            @if(request()->routeIs($element['route']))
                                @php
                                    $menu[$key]['is_open'] = true;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @foreach($menu as $item)
                    @if($item['route'] === '#')

                        <!-- Parent item -->
                        <li class="{{ $item['is_open'] ? 'nav-item menu-open' : 'nav-item' }}">
                            <a class="{{ $item['is_open'] ? 'nav-link active' : 'nav-link' }}" href="{{ $item['route'] }}">
                                <i class="{{ $item['icon'] }} nav-icon"></i>
                                <p>{{ $item['title'] }} <i class="right fa fa-angle-left"></i></p>
                            </a>

                            <ul class="nav nav-treeview"{{ $item['is_open'] ? ' style="display: block;"' : '' }}>
                                @foreach($item['submenu'] as $element)
                                    <!-- Child item -->
                                    <li class="nav-item">
                                        <a class="{{ request()->routeIs($element['route']) ? 'nav-link active' : 'nav-link' }}" href="{{ route($element['route']) }}">
                                            <i class="{{ $element['icon'] }} nav-icon"></i>
                                            <p>{{ $element['title'] }}</p>
                                        </a>
                                    </li>
                                    <!-- /.child item -->
                                @endforeach
                            </ul>

                        </li>
                        <!-- /.parent item -->

                    @endif
                    @if($item['route'] === '#')
                        @php
                            continue;
                        @endphp
                    @endif
                    <!-- Simple menu item -->
                    <li class="nav-item">
                        <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route'])  ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon {{ $item['icon'] }}"></i>
                            <p>{{ $item['title'] }}</p>
                        </a>
                    </li>
                    <!-- /.simple menu item -->
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
