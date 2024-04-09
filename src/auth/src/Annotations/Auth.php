<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Auth\Annotations;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Auth extends AbstractAnnotation
{
    /**
     * @var string[]
     */
    public $guards;

    /**
     * @var bool
     */
    public $passable;

    public function __construct(public ?array $value = null)
    {
        // parent::__construct();
        if (isset($value['value'])) {
            $value['value'] = empty($value['value']) ? [] : (is_array($value['value']) ? array_unique($value['value']) : [$value['value']]);
            $this->guards = $value['value'];
        }
        if (isset($value['passable'])) {
            $this->passable = (bool) $value['passable'];
        }
    }
}
