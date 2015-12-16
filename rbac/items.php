<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'sign-up' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'updateOwnProfile' => [
        'type' => 2,
        'ruleName' => 'isProfileOwner',
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userRole',
        'children' => [
            'login',
            'logout',
            'error',
            'sign-up',
            'index',
            'view',
            'create',
            'update',
            'updateOwnProfile',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userRole',
        'children' => [
            'delete',
            'admin',
            'user',
        ],
    ],
];
