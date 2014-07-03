<?php
 
namespace Spiffy\Validate;

use Spiffy\Validate\TestAsset\TestValidator;

/**
 * @coversDefaultClass \Spiffy\Validate\ValidatorChain
 */
class ValidatorChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Spiffy\Validate\Exception\InvalidValidatorException
     * @expectedExceptionMessage Validator must be a Closure or Spiffy\Validate\Validator 
     */
    public function testAddThrowsExceptionForInvalidValidator()
    {
        $v = new ValidatorChain();
        $v->add(false);
    }
    
    /**
     * @covers ::add, ::addClosure, ::getValidators
     */
    public function testAddGetValidators()
    {
        $v = new ValidatorChain();
        $v->add(function() { return true; });
        $v->add(function() { return false; });
        
        $this->assertCount(2, $v->getValidators());
        
        $v->add(new TestValidator());
        
        $this->assertCount(3, $v->getValidators());
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