<?php

return [
    'users' => [
        'title' => [
            'route_name' => 'admin.users.*',
            'class_true' => 'border-start',
            'target' => 'menu-usuario',
            'title' => 'Usuários',
        ],
        'menus' => [
            [
                'route_name' => 'admin.users.create',
                'item_name'  => 'Cadastrar',
            ],
            [
                'route_name' => 'admin.users.index',
                'item_name'  => 'Listagem',
            ],

        ],
    ],

    'exit' => [
        'route_name' => 'logout',
        'item_name'  => 'Sair',
    ],
];
