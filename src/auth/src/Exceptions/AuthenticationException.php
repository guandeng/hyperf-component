<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Auth\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    /**
     * Create a new authentication exception.
     */
    public function __construct(string $message = 'Unauthenticated.', public array $guards = [], public ?string $redirectTo = null)
    {
        parent::__construct($message);
    }

    /**
     * Get the guards that were checked.
     */
    public function guards(): array
    {
        return $this->guards;
    }

    /**
     * Get the path the user should be redirected to.
     */
    public function redirectTo(): string
    {
        return $this->redirectTo;
    }
}
