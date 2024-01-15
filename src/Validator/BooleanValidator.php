<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

class BooleanValidator implements ValidatorInterface
{
    public function validate(mixed $value): bool
    {
        return \in_array($value, [0, 1], true);
    }
}
