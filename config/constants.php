<?php

return [
    'avatars' => [
        'save_path' => public_path('data/avatars/'),
        'url' => 'data/avatars/',
        'file_extension' => 'png'
    ],
    'routes_detail' => [
        'admin.index' => [
            'title' => 'Panel administracyjny',
            'prev_pages' => []
        ],

        'admin.users.index' => [
            'title' => 'Użytkownicy',
            'prev_pages' => [
                'admin.index'
            ]
        ],
        'admin.users.add'  => [
            'title' => 'Dodaj Użytkownika',
            'prev_pages' => [
                'admin.index',
                'admin.users.index'
            ]
        ],
        'admin.users.edit'  => [
            'title' => 'Edytuj użytkownika',
            'prev_pages' => [
                'admin.index',
                'admin.users.index'
            ]
        ],
        'admin.users.profile'  => [
            'title' => 'Profil użytkownika',
            'prev_pages' => [
                'admin.index',
                'admin.users.index'
            ]
        ],
    ]
];
