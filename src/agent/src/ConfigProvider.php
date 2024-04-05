<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Agent;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'Agent' => AgentServiceProvider::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for agent.',
                    'source' => __DIR__ . '/../publish/agent.php',
                    'destination' => BASE_PATH . '/config/autoload/agent.php',
                ],
            ],
        ];
    }
}
