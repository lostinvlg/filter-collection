<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Normalizer;

interface NormalizerInterface
{
    public function normalize(mixed $value);
}
