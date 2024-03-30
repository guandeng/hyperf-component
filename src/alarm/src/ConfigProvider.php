<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Alarm;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'id' => 'config',
                    'description' => '配置文件',
                    'source' => __DIR__ . '/../publish/alarm.php',
                    'destination' => BASE_PATH . '/config/autoload/alarm.php',
                ],
            ],
        ];
    }
}
