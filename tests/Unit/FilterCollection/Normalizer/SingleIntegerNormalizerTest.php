<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Normalizer;

use Lostinvlg\FilterCollection\Normalizer\SingleIntegerNormalizer;
use PHPUnit\Framework\TestCase;

final class SingleIntegerNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $normalizer = new SingleIntegerNormalizer();
        $this->assertSame(100, $normalizer->normalize('100'));
        $this->assertSame(100, $normalizer->normalize('100.00'));
        $this->assertSame(100, $normalizer->normalize(100));
        $this->assertSame(100, $normalizer->normalize(100.0));
        $this->assertSame(1, $normalizer->normalize(['100']));
    }
}
