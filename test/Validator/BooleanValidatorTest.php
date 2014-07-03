<?php

namespace Spiffy\Input\Validator;

/**
 * @coversDefaultClass \Spiffy\Input\Validator\BooleanValidator
 */
class BooleanValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::valid
     */
    public function testValid()
    {
        $v = new BooleanValidator();
        $this->assertFalse($v->valid('asdf'));
        $this->assertTrue($v->valid(true));
        $this->assertFalse($v->valid(false));
        $this->assertTrue($v->valid('on'));
        $this->assertTrue($v->valid('yes'));
    }
}
