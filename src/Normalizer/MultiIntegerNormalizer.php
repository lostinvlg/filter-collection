<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Normalizer;

use Lostinvlg\FilterCollection\Delimiter;

final class MultiIntegerNormalizer implements NormalizerInterface
{
    public function normalize(mixed $value): array
    {
        if (\is_string($value)) {
            $value = \explode(Delimiter::MULTI->value, $value);
        } elseif (!\is_array($value)) {
            throw new \InvalidArgumentException('Invalid multi value passed.');
        }

        return \array_map('intval', $value);
    }
}
