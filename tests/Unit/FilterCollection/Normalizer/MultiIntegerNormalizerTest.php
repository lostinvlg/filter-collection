<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Normalizer;

use Lostinvlg\FilterCollection\Delimiter;
use Lostinvlg\FilterCollection\Normalizer\MultiIntegerNormalizer;
use PHPUnit\Framework\TestCase;

final class MultiIntegerNormalizerTest extends TestCase
{
    public function testIncorrectValueType(): void
    {
        $normalizer = new MultiIntegerNormalizer();
        $this->expectException(\InvalidArgumentException::class);
        $normalizer->normalize(0);
    }

    public function testCorrectValues(): void
    {
        $normalizer = new MultiIntegerNormalizer();
        $d = Delimiter::MULTI->value;
        [$int1, $int2, $int3] = $normalizer->normalize('1'.$d.'20'.$d.'199.00');
        $this->assertSame(1, $int1);
        $this->assertSame(20, $int2);
        $this->assertSame(199, $int3);

        [$int1, $int2] = $normalizer->normalize([100.0, '200']);
        $this->assertSame(100, $int1);
        $this->assertSame(200, $int2);
    }
}
