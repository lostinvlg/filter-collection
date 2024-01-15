<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

class MultiValidator implements ValidatorInterface
{
    public function __construct(private array $rules)
    {
    }

    public function validate(mixed $value): bool
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException('Invalid multi value passed.');
        }
        foreach ($value as $item) {
            if (!\in_array($item, $this->rules, true)) {
                return false;
            }
        }

        return true;
    }
}
