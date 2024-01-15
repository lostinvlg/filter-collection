<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Validator;

use Lostinvlg\FilterCollection\Validator\SingleValidator;
use PHPUnit\Framework\TestCase;

final class SingleValidatorTest extends TestCase
{
    public function testIncorrectValus(): void
    {
        $validator = new SingleValidator([1, 2, 3]);
        $this->assertFalse($validator->validate(0));
        $this->assertFalse($validator->validate(4));
        $this->assertFalse($validator->validate('test'));
        $this->assertFalse($validator->validate(['not an integer']));
    }

    public function testCorrectValus(): void
    {
        $validator = new SingleValidator([1, 2, 3]);
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(2));
        $this->assertTrue($validator->validate(3));
    }
}
