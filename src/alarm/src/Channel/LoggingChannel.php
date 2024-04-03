<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Alarm\Channel;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

class LoggingChannel implements ChannelInterface
{
    protected $logger;

    public function __construct(
        protected ContainerInterface $container,
        protected ConfigInterface $config
    ) {
        $logCfg = $this->config->get('alarm.channels.logging', '');
        $this->logger = $this->container->get(LoggerFactory::class)->get($logCfg['name'], $logCfg['group']);
    }

    public function notice(array $data)
    {
        $this->logger->notice($this->config->get('alarm.title', ''), $data);
    }

    public function warning(array $data)
    {
        $this->logger->warning($this->config->get('alarm.title', ''), $data);
    }
}
