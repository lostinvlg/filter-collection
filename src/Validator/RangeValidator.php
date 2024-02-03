<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

class RangeValidator implements ValidatorInterface
{
    public function __construct(private array $rules)
    {
        if (2 !== \count($rules) || !isset($rules[0], $rules[1])) {
            throw new \InvalidArgumentException('RangeValidator supports only two values.');
        }
    }

    public function validate(mixed $value): bool
    {
        if (!\is_array($value) || 2 !== \count($value)) {
            throw new \InvalidArgumentException('Invalid range value passed.');
        }
        $min = (float) $value[0];
        $max = (float) $value[1];
        if (0.0 === $min) {
            return $max <= $this->rules[1];
        }
        if (0.0 === $max) {
            return $min >= $this->rules[0];
        }

        return $min <= $max && $min >= $this->rules[0] && $max <= $this->rules[1];
    }
}
