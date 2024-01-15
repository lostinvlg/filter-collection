<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

final class SingleValidator implements ValidatorInterface
{
    public function __construct(private array $rules)
    {
    }

    public function validate(mixed $value): bool
    {
        return \in_array($value, $this->rules, true);
    }
}
