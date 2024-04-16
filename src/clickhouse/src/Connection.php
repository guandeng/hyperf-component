<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Clickhouse;

use Hyperf\Contract\ConnectionInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Database\ConnectionInterface as DbConnectionInterface;
use Hyperf\DbConnection\Traits\DbConnection;
use Hyperf\Pool\Connection as BaseConnection;
use Hyperf\Pool\Exception\ConnectionException;
use HyperfComponent\Clickhouse\Pool\DbPool;
use Psr\Container\ContainerInterface;
use Tinderbox\Clickhouse\Client;
use Tinderbox\Clickhouse\Server;
use Tinderbox\Clickhouse\ServerProvider;

class Connection extends BaseConnection implements ConnectionInterface, DbConnectionInterface
{
    use DbConnection;

    protected DbPool $pool;

    protected DbConnectionInterface $connection;

    protected array $config;

    protected StdoutLoggerInterface $logger;

    protected $transaction = false;

    protected Client $client;

    public function __construct(ContainerInterface $container, DbPool $pool, array $config)
    {
        parent::__construct($container, $pool);
        $this->config = $config;
        $this->logger = $container->get(StdoutLoggerInterface::class);

        $this->reconnect();
    }

    public function __call($name, $arguments)
    {
        return $this->connection->{$name}(...$arguments);
    }

    public function getActiveConnection(): DbConnectionInterface
    {
        if ($this->check()) {
            return $this;
        }

        if (! $this->reconnect()) {
            throw new ConnectionException('Connection reconnect failed.');
        }

        return $this;
    }

    public function reconnect(): bool
    {
        $this->close();

        $this->connection = $this->makeConnection($this->config);
        $this->lastUseTime = microtime(true);

        return true;
    }

    public function close(): bool
    {
        unset($this->connection);

        return true;
    }

    public function release(): void
    {
        parent::release();
    }

    public function setTransaction(bool $transaction): void
    {
        $this->transaction = $transaction;
    }

    public function isTransaction(): bool
    {
        return $this->transaction;
    }

    /**
     * get client clickhouse.
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * make connection clickhouse.
     * @param mixed $config
     */
    public function makeConnection($config)
    {
        $server = new Server(
            $config['host'],
            $config['port'],
            $config['database'],
            $config['username'],
            $config['password']
        );

        $serverProvider = (new ServerProvider())->addServer($server);
        $this->client = new Client($serverProvider);

        return $this->client;
    }

    /**
     * Refresh pdo and readPdo for current connection.
     */
    protected function refresh(\Hyperf\Database\Connection $connection)
    {
        $this->logger->warning('Database connection refreshed.');
    }
}
