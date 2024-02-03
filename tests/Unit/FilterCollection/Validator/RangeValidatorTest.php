<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Validator;

use Lostinvlg\FilterCollection\Validator\RangeValidator;
use PHPUnit\Framework\TestCase;

final class RangeValidatorTest extends TestCase
{
    public function testInvalidRules(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new RangeValidator([1, 2, 3]);
    }

    public function testInvalidValues(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $validator = new RangeValidator([1, 2]);
        $validator->validate([0, 1, 2]);
    }

    public function testNotValidValues(): void
    {
        $range = [100, 200];
        $validator = new RangeValidator($range);
        $this->assertFalse($validator->validate([99, 190]));
        $this->assertFalse($validator->validate([101, 201]));
        $this->assertFalse($validator->validate([1, 300]));
        $this->assertFalse($validator->validate([160, 150]));
        $this->assertFalse($validator->validate([1, 0]));
        $this->assertFalse($validator->validate([0, 201]));
        $this->assertFalse($validator->validate([99, 0]));
    }

    public function testValidValues(): void
    {
        $range = [100, 200];
        $validator = new RangeValidator($range);
        $this->assertTrue($validator->validate([100, 200]));
        $this->assertTrue($validator->validate([101, 199]));
        $this->assertTrue($validator->validate([150, 150]));
        $this->assertTrue($validator->validate([0, 200]));
        $this->assertTrue($validator->validate([100, 0]));
    }
}
