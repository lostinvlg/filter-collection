<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Normalizer;

use Lostinvlg\FilterCollection\Delimiter;

class DoubleRangeNormalizer implements NormalizerInterface
{
    public function normalize(mixed $value): array
    {
        if (\is_string($value)) {
            $value = \explode(Delimiter::RANGE->value, $value);
        } elseif (!\is_array($value)) {
            throw new \InvalidArgumentException('Invalid range value passed.');
        }
        if (2 !== \count($value)) {
            throw new \InvalidArgumentException('Invalid range values passed.');
        }

        return array_map('floatval', $value);
    }
}
