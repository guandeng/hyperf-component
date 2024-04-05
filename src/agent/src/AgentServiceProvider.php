<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Agent;

use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerInterface;

use function Hyperf\Collection\data_get;
use function Hyperf\Support\make;

class AgentServiceProvider
{
    public function __invoke(ContainerInterface $container)
    {
        $request = $container->get(RequestInterface::class);
        $headers = $request->getHeaders();

        static $headerServerMapping = [
            'x-real-ip' => 'REMOTE_ADDR',
            'x-real-port' => 'REMOTE_PORT',
            'server-protocol' => 'SERVER_PROTOCOL',
            'server-name' => 'SERVER_NAME',
            'server-addr' => 'SERVER_ADDR',
            'server-port' => 'SERVER_PORT',
            'scheme' => 'REQUEST_SCHEME',
        ];

        $server = $request->getServerParams();
        foreach ($headers as $key => $value) {
            $value = is_array($value) ? implode('', array_unique(array_filter($value))) : $value;
            if (isset($headerServerMapping[$key])) {
                $server[$headerServerMapping[$key]] = $value;
            } else {
                $key = str_replace('-', '_', $key);
                $server['http_' . $key] = $value;
            }
        }
        $server = array_change_key_case($server, CASE_UPPER);

        if (strpos($server['REQUEST_URI'], '?') === false
            && isset($server['QUERY_STRING'])
            && strlen($server['QUERY_STRING']) > 0
        ) {
            $server['REQUEST_URI'] .= '?' . $server['QUERY_STRING'];
        }

        if (! isset($server['argv'])) {
            $server['argv'] = isset($GLOBALS['argv']) ? $GLOBALS['argv'] : [];
            $server['argc'] = isset($GLOBALS['argc']) ? $GLOBALS['argc'] : 0;
        }

        return make(Agent::class, ['headers' => $server, 'userAgent' => data_get($server, 'HTTP_USER_AGENT')]);
    }
}
