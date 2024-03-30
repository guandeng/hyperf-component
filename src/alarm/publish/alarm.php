<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */
use function Hyperf\Support\env;

return [
    'enable' => env('ALARM_ENABLE', false),

    'title' => env('ALARM_TITLE', 'alarm'),

    'default' => env('ALARM_CHANNEL', 'stdout'),

    'channels' => [
        'logging' => [
            'group' => env('ALARM_CHANNEL_LOGGING_GROUP', 'default'),
            'name' => env('ALARM_CHANNEL_LOGGING_NAME', 'hyperf'),
        ],
        'stdout',
    ],

    'timeout' => [
        'notice' => env('ALARM_TIME_OUT_NOTICE', 3),
        'warning' => env('ALARM_TIME_OUT_WARNING', 5),
    ],
];
