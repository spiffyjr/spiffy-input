<?php
 
namespace Spiffy\Input\Filter;

use Spiffy\Input\OptionsAware;
use Spiffy\Input\OptionsAwareTrait;

final class StripTagsFilter implements Filter, OptionsAware
{   
    use OptionsAwareTrait;
    
    /**
     * {@inheritDoc}
     */
    public function filter($input)
    {
        return strip_tags($input, $this->getOption('allowed'));
    }
}
