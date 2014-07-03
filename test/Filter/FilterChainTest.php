<?php
 
namespace Spiffy\Input\Filter;

use Spiffy\Input\Filter\TestAsset\TestFilter;

/**
 * @coversDefaultClass \Spiffy\Input\Filter\FilterChain
 */
class FilterChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Spiffy\Input\Filter\Exception\InvalidFilterException
     * @expectedExceptionMessage Filter must be a Closure or Spiffy\Input\Filter\Filter 
     */
    public function testAddThrowsExceptionForInvalidFilter()
    {
        $f = new FilterChain();
        $f->add(false);
    }
    
    /**
     * @covers ::add, ::addClosure, ::filters
     */
    public function testAddAndFilters()
    {
        $f = new FilterChain();
        $this->assertNull($f->filters());
        
        $f->add(function() { return true; });
        $f->add(function() { return false; });
        
        $this->assertCount(2, $f->filters());
        
        $f->add(new TestFilter());
        
        $this->assertCount(3, $f->filters());

        // Test cloning
        $first = $f->filters();
        $second = $f->filters();

        $this->assertEquals($first, $second);
        $this->assertNotSame($first, $second);
    }

    /**
     * @covers ::filter
     */
    public function testFilter()
    {
        $f = new FilterChain();
        $this->assertSame('foo', $f->filter('foo'));        
        
        $f->add(function() { return null; });
        
        $this->assertNull($f->filter(true));
        $this->assertNull($f->filter('asdf'));
        
        $f = new FilterChain();
        $f->add(new TestFilter());
        $this->assertSame('foo.foo.bar', $f->filter('foo'));

        $f->add(function($input) { return $input . 'bar'; });
        $this->assertSame('foo.foo.barbar', $f->filter('foo'));
        
        $f->add(function($input) { return 'baz' . $input; }, 1000);
        $this->assertSame('foo.bazfoo.barbar', $f->filter('foo'));
    }
}