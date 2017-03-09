<?php
return [
    'path' => [
        'upload' => '/uploads',
        'image' => '/uploads/images',
    ],

    'user' => [
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
    ],

    'garage' => [
        'default_avatar' => 'default.jpg',
        'status' => [
            'activated' => 1,
            'unactivated' => 0,
        ],
    ],
    'timeworking' => [
        'fromHour' => [
            '00' => '00',
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
        ],
        'Min' => [
            '00' => '00',
            '15' => '15',
            '30' => '30',
            '45' => '45',
        ],
        'toHour' => [
            '12' => '12',
            '13' => '13',
            '14' => '14',
            '15' => '15',
            '16' => '16',
            '17' => '17',
            '18' => '18',
            '19' => '19',
            '20' => '20',
            '21' => '21',
            '22' => '22',
            '23' => '23',
        ]
    ]
];
