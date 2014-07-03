<?php
 
namespace Spiffy\Input\Validator;

use Spiffy\Input\Validator\TestAsset\TestValidator;

/**
 * @coversDefaultClass \Spiffy\Input\Validator\ValidatorChain
 */
class ValidatorChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Spiffy\Input\Validator\Exception\InvalidValidatorException
     * @expectedExceptionMessage Validator must be a Closure or Spiffy\Input\Validator\Validator 
     */
    public function testAddThrowsExceptionForInvalidValidator()
    {
        $v = new ValidatorChain();
        $v->add(false);
    }
    
    /**
     * @covers ::add, ::addClosure, ::validators
     */
    public function testAddAndValidators()
    {
        $v = new ValidatorChain();
        $this->assertNull($v->validators());
        
        $v->add(function() { return true; });
        $v->add(function() { return false; });
        
        $this->assertCount(2, $v->validators());
        
        $v->add(new TestValidator());
        
        $this->assertCount(3, $v->validators());

        // Test cloning
        $first = $v->validators();
        $second = $v->validators();
        
        $this->assertEquals($first, $second);
        $this->assertNotSame($first, $second);
    }

    /**
     * @covers ::valid
     */
    public function testValid()
    {
        $v = new ValidatorChain();
        $v->add(function() { return false; });
        $this->assertFalse($v->valid(null));
        
        $v = new ValidatorChain();
        $v->add(function() { return true; });
        $this->assertTrue($v->valid(false));
        
        $v = new ValidatorChain();
        $v->add(new TestValidator());
        $this->assertFalse($v->valid(false));
        $this->assertTrue($v->valid(true));
    }
}