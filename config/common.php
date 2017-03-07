<?php
$configs = [];
$configs['path'] = [
    'upload' => '/uploads',
    'image' => '/images',
    'doc' => '/docs',
    'user' => '/users',
    'garage' => '/garages',
    'avatar' => '/avatar',
];

$configs['user'] = [
    'avatar_path' => $configs['path']['upload'] . $configs['path']['image'] . $configs['path']['user'] . $configs['path']['avatar'] . '/',
    'default_avatar' => 'default.jpg',
    'role' => [
        'user' => 1,
        'partner' => 2,
        'admin' => 3,
    ],
    'status' => [
        'activated' => 1,
        'unactivated' => 0,
    ],
    'task_bar_status' => [
        'update_profile' => 1,
        'change_password' => 2,
    ]
];

$configs['user'] = [
    'avatar_path' => $configs['path']['upload'] . $configs['path']['image'] . $configs['path']['garage'] . $configs['path']['avatar'] . '/',
    'default_avatar' => 'default.jpg',
    'status' => [
        'activated' => 1,
        'unactivated' => 0,
    ],
];

return $configs;
