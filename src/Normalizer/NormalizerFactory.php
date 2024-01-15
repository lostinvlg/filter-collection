<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Normalizer;

use Lostinvlg\FilterCollection\FilterType;

class NormalizerFactory
{
    public function make(FilterType $type): NormalizerInterface
    {
        return match ($type) {
            FilterType::BOOLEAN => new SingleIntegerNormalizer(),
            FilterType::SINGLE => new SingleIntegerNormalizer(),
            FilterType::MULTI => new MultiIntegerNormalizer(),
            FilterType::RANGE => new DoubleRangeNormalizer(),
            FilterType::COLOR => new MultiIntegerNormalizer(),
            default => throw new \InvalidArgumentException('Unknown filter type given.'),
        };
    }
}
