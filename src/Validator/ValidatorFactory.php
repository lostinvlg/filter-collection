<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Validator;

use Lostinvlg\FilterCollection\Filter;
use Lostinvlg\FilterCollection\FilterType;
use Lostinvlg\FilterCollection\FilterValue;

final class ValidatorFactory
{
    public function make(Filter $filter): ValidatorInterface
    {
        $values = \array_map(static fn (FilterValue $value) => $value->value, $filter->getValues());

        return match ($filter->type) {
            FilterType::BOOLEAN => new BooleanValidator(),
            FilterType::SINGLE => new SingleValidator($values),
            FilterType::MULTI => new MultiValidator($values),
            FilterType::RANGE => new RangeValidator($values),
            FilterType::COLOR => new MultiValidator($values),
            default => throw new \InvalidArgumentException('Unknown filter type given.'),
        };
    }
}
