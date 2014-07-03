<?php
 
namespace Spiffy\Input;

/**
 * @coversDefaultClass \Spiffy\Input\BasicInput
 */
class BasicInputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct, ::getName
     */
    public function testGetName()
    {
        $name = 'foo';
        
        $i = new BasicInput($name);
        $this->assertSame($name, $i->getName());
    }

    /**
     * @covers ::getRawValue, ::setValue, ::getValue
     */
    public function testSetAndGetValues()
    {
        $i = new BasicInput('foo');
        $this->assertNull($i->getRawValue());
        $this->assertNull($i->getValue());
        
        $value = new \StdClass();
        
        $i->setValue($value);
        $this->assertSame($value, $i->getRawValue());
        $this->assertNull($i->getValue());
        
        $i->filters()->add(function() { return null; });
        $i->valid();
        
        $this->assertSame($value, $i->getRawValue());
        $this->assertNull($i->getValue());
    }

    /**
     * @covers ::filters
     */
    public function testFiltersLazyLoads()
    {
        $i = new BasicInput('foo');
        $this->assertInstanceOf('Spiffy\Input\Filter\FilterChain', $i->filters());
    }

    /**
     * @covers ::validators
     */
    public function testValidatorsLazyLoads()
    {
        $i = new BasicInput('foo');
        $this->assertInstanceOf('Spiffy\Input\Validator\ValidatorChain', $i->validators());
    }

    /**
     * @covers ::valid
     */
    public function testValid()
    {
        $i = new BasicInput('foo');
        $this->assertTrue($i->valid());
        
        $i->validators()->add(function($input) {
            return 'foo' == $input;
        });
        
        $this->assertFalse($i->valid());
        
        $i->setValue('foo');
        $this->assertTrue($i->valid());
    }
}
