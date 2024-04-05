<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */
use Hyperf\Context\ApplicationContext;

if (! function_exists('agent')) {
    function agent()
    {
        $container = ApplicationContext::getContainer();
        if (! $container->has('agent')) {
            return null;
        }

        return $container->get('agent');
    }
}
