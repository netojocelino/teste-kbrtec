<?php

return [
    'users' => [
        'title' => [
            'route_name' => 'admin.users.*',
            'target' => 'menu-usuario',
            'title' => 'Usuários',
        ],
        'menus' => [
            [
                'route_name' => 'admin.users.index',
                'item_name'  => 'Listagem',
            ],
            [
                'route_name' => 'admin.users.create',
                'item_name'  => 'Cadastrar',
            ],

        ],
    ],

    'championship' => [
        'title' => [
            'route_name' => 'admin.championship.*',
            'target'     => 'menu_championship',
            'title'      => 'Campeonatos',
        ],
        'menus' => [
            [
                'route_name' => 'admin.championship.index',
                'item_name'  => 'Listagem',
            ],
            [
                'route_name' => 'admin.championship.create',
                'item_name'  => 'Cadastrar',
            ],
        ],
    ],

    'exit' => [
        'route_name' => 'logout',
        'item_name'  => 'Sair',
    ],
];
