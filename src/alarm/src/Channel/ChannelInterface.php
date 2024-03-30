<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Alarm\Channel;

interface ChannelInterface
{
    public function notice(array $data);

    public function warning(array $data);
}
