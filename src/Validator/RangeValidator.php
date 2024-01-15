<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

class RangeValidator implements ValidatorInterface
{
    public function __construct(private array $rules)
    {
        if (2 !== \count($rules)) {
            throw new \InvalidArgumentException('RangeValidator supports only two values.');
        }
    }

    public function validate(mixed $value): bool
    {
        if (!\is_array($value) || 2 !== \count($value)) {
            throw new \InvalidArgumentException('Invalid range value passed.');
        }

        return $value[0] <= $value[1] && $value[0] >= $this->rules[0] && $value[1] <= $this->rules[1];
    }
}
