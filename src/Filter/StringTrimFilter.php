<?php
 
namespace Spiffy\Input\Filter;

use Spiffy\Input\OptionsAware;
use Spiffy\Input\OptionsAwareTrait;

final class StringTrimFilter implements Filter, OptionsAware
{   
    use OptionsAwareTrait;
    
    /**
     * {@inheritDoc}
     */
    public function filter($input)
    {
        $charlist = $this->getOption('charlist');
        return $charlist ? trim($input, $charlist) : trim($input);
    }
}
