<?php
 
namespace Spiffy\Input\Validator;

final class InArrayValidator extends AbstractValidator
{
    /** @var string */
    protected $errorMessage = 'Must be a valid entry';
    
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return in_array($input, $this->getOption('array'));
    }
}
