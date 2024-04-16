<?php

namespace HyperfComponent\Clickhouse;

use HyperfComponent\Clickhouse\Pool\PoolFactory;

use function Hyperf\Support\env;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                PoolFactory::class => PoolFactory::class,
                ConnectionResolver::class => ConnectionResolver::class
            ]
        ];
    }
}
