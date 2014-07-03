<?php
 
namespace Spiffy\Input\Filter\TestAsset;

use Spiffy\Input\Filter\Filter;

class TestFilter implements Filter
{
    /**
     * {@inheritDoc}
     */
    public function filter($input)
    {
        return 'foo.' . $input . '.bar';
    }
}