<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Normalizer;

use Lostinvlg\FilterCollection\Delimiter;
use Lostinvlg\FilterCollection\Normalizer\DoubleRangeNormalizer;
use PHPUnit\Framework\TestCase;

final class DoubleRangeNormalizerTest extends TestCase
{
    public function testInvalidRangeValue(): void
    {
        $normalizer = new DoubleRangeNormalizer();
        $this->expectException(\InvalidArgumentException::class);
        $normalizer->normalize(['incorrect value']);
    }

    public function testInvalidValueType(): void
    {
        $normalizer = new DoubleRangeNormalizer();
        $this->expectException(\InvalidArgumentException::class);
        $normalizer->normalize(0);
    }

    public function testInvalidTotalValues(): void
    {
        $normalizer = new DoubleRangeNormalizer();
        $this->expectException(\InvalidArgumentException::class);
        $normalizer->normalize([0, 1, 2]);
        $this->expectException(\InvalidArgumentException::class);
        $d = Delimiter::RANGE->value;
        $normalizer->normalize('first'.$d.'second'.$d.'extra');
    }

    public function testValidValues(): void
    {
        $normalizer = new DoubleRangeNormalizer();
        [$min, $max] = $normalizer->normalize('100;200');
        $this->assertSame(100.0, $min);
        $this->assertSame(200.0, $max);

        [$min2, $max2] = $normalizer->normalize(['100', '300']);
        $this->assertSame(100.0, $min2);
        $this->assertSame(300.0, $max2);
    }
}
