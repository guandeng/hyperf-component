<?php

namespace HyperfComponent\Clickhouse;

use Hyperf\Database\Migrations\Migration as BaseMigration;

class Migration extends BaseMigration
{
    /**
     *
     * @param string $sql
     * @return \ClickHouseDB\Statement
     */
    protected static function write(string $sql)
    {
        /** @var \ClickHouseDB\Client $client */
        $client = Clickhouse::connection('clickhouse')->getClient();
        return $client->writeOne($sql);
    }
}
