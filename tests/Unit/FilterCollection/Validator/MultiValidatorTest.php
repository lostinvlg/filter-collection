<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Validator;

use Lostinvlg\FilterCollection\Validator\MultiValidator;
use PHPUnit\Framework\TestCase;

final class MultiValidatorTest extends TestCase
{
    public function testInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $validator = new MultiValidator([]);
        $validator->validate('not an array');
    }

    public function testValidate(): void
    {
        $validator = new MultiValidator([1, 2, 3, 4, 5]);
        $this->assertTrue($validator->validate([1]));
        $this->assertFalse($validator->validate([0]));
    }
}
