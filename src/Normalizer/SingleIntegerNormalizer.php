<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Normalizer;

class SingleIntegerNormalizer implements NormalizerInterface
{
    public function normalize(mixed $value): int
    {
        return (int) $value;
    }
}
