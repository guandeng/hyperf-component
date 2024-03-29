<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfTest\Amqp;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
#[CoversNothing]
class InitTest extends TestCase
{
    public function testTmp()
    {
        $tmp = 'test';
        $this->assertSame('test', $tmp);
    }
}
