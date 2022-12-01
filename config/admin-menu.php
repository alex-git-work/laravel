<?php

return [
    [
        'route' => 'admin',
        'title' => 'Главная',
        'icon' => 'fa fa-home',
    ],
    [
        'route' => '#',
        'title' => 'Статьи',
        'icon' => 'fa fa-file',
        'submenu' => [
            [
                'route' => 'admin.article.index',
                'title' => 'Активные',
                'icon' => 'far fa-circle',
            ],
            [
                'route' => 'admin.article.hidden',
                'title' => 'Скрытые',
                'icon' => 'far fa-circle',
            ],
        ],
        'is_open' => false,
    ],
    [
        'route' => 'admin.article.create',
        'title' => 'Создать статью',
        'icon' => 'fa fa-plus-circle',
    ],
    [
        'route' => 'admin.news.index',
        'title' => 'Новости',
        'icon' => 'fas fa-bars',
    ],
    [
        'route' => 'admin.feedback',
        'title' => 'Обратная связь',
        'icon' => 'fa fa-envelope',
    ],
];
