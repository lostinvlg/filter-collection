<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests;

use Lostinvlg\FilterCollection\FilterValue;
use PHPUnit\Framework\TestCase;

final class FilterValueTest extends TestCase
{
    public function testFilterValue(): void
    {
        $fv = new FilterValue(1, 'one');
        $this->assertSame(1, $fv->value);
        $this->assertSame('one', $fv->title);
    }

    public function testSerialization(): void
    {
        $fv = new FilterValue(1, 'one');
        \json_encode($fv, JSON_THROW_ON_ERROR);
        $arr = $fv->jsonSerialize();
        $this->assertArrayHasKey('v', $arr);
        $this->assertArrayHasKey('t', $arr);
        $this->assertSame(1, $arr['v']);
        $this->assertSame('one', $arr['t']);
    }
}
