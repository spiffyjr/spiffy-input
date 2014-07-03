<?php

namespace Spiffy\Validate;

/**
 * @coversDefaultClass \Spiffy\Validate\EmailValidator
 */
class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $v = new EmailValidator();
        $this->assertFalse($v->valid('asdf'));
        $this->assertFalse($v->valid(true));
        $this->assertTrue($v->valid('foo@bar.com'));
    }
}