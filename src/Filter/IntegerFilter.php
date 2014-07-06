<?php
 
namespace Spiffy\Input\Filter;

use Spiffy\Input\OptionsAware;
use Spiffy\Input\OptionsAwareTrait;

final class IntegerFilter implements Filter
{   
    /**
     * {@inheritDoc}
     */
    public function filter($input)
    {
        return (int) $input;
    }
}
