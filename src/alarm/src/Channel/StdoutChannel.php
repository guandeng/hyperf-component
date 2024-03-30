<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Alarm\Channel;

use Hyperf\Codec\Json;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;

class StdoutChannel implements ChannelInterface
{
    public function __construct(
        protected ConfigInterface $config,
        protected StdoutLoggerInterface $logger
    ) {
    }

    public function notice(array $data)
    {
        $this->logger->notice($this->message($data));
    }

    public function warning(array $data)
    {
        $this->logger->warning($this->message($data));
    }

    private function message(array $data): string
    {
        return $this->config->get('alarm.title') . ' : ' . Json::encode($data);
    }
}
