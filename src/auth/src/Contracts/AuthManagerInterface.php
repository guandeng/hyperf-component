<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Auth\Contracts;

interface AuthManagerInterface
{
    /**
     * Get a guard instance by name.
     */
    public function guard(?string $name = null): GuardInterface|StatefulGuardInterface|StatelessGuardInterface;

    /**
     * Set the default guard the factory should serve.
     */
    public function shouldUse(string $name): void;
}
