<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace PHPSTORM_META;

use Hyperf\Context\Context;
use Psr\Container\ContainerInterface;

use function app;
use function di;
use function make;
use function optional;
use function resolve;
use function tap;

// Reflect
override(app(0), map(['' => '@']));
override(di(0), map(['' => '@']));
override(resolve(0), map(['' => '@']));
override(make(0), map(['' => '@']));
override(optional(0), type(0));
override(tap(0), type(0));

override(\HyperfComponent\Helpers\app(0), map(['' => '@']));
override(\HyperfComponent\Helpers\di(0), map(['' => '@']));
override(Context::get(0), map(['' => '@']));
override(\Hyperf\Support\make(0), map(['' => '@']));
override(\Hyperf\Support\optional(0), type(0));
override(\Hyperf\Tappable\tap(0), type(0));
override(ContainerInterface::get(0), map(['' => '@']));
