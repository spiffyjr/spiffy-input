<?php

namespace Spiffy\Input\Validator;

/**
 * @coversDefaultClass \Spiffy\Input\Validator\EmailValidator
 */
class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::valid
     */
    public function testValid()
    {
        $v = new EmailValidator();
        $this->assertFalse($v->valid('asdf'));
        $this->assertFalse($v->valid(true));
        $this->assertTrue($v->valid('foo@bar.com'));
    }
}