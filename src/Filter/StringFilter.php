<?php
 
namespace Spiffy\Input\Filter;

final class StringFilter implements Filter
{
    /** @var null */
    private $flags;

    /**
     * @param null $flags
     */
    public function __construct($flags = null)
    {
        $this->flags = $flags;
    }
    
    /**
     * {@inheritDoc}
     */
    public function filter($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING, $this->flags);
    }
}