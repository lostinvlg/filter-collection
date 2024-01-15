<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests\Validator;

use Lostinvlg\FilterCollection\Validator\BooleanValidator;
use PHPUnit\Framework\TestCase;

class BooleanValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $validator = new BooleanValidator();
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(0));
        $this->assertFalse($validator->validate(2));
        $this->assertFalse($validator->validate('not an integer'));
    }
}
