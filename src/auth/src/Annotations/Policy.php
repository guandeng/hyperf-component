<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Auth\Annotations;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;
use InvalidArgumentException;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Policy extends AbstractAnnotation
{
    /**
     * @var string[]
     */
    public $models;

    public function __construct(?array $value = null)
    {
        // parent::__construct($value);
        if (isset($value['value'])) {
            $value['value'] = empty($value['value']) ? [] : (is_array($value['value']) ? array_unique($value['value']) : [$value['value']]);
            if (empty($value['value'])) {
                throw new InvalidArgumentException('Policy annotation requires at least one model.');
            }
            $this->models = $value['value'];
        }
    }
}
