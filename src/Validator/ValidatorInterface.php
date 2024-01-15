<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

interface ValidatorInterface
{
    public function validate(mixed $value): bool;
}
