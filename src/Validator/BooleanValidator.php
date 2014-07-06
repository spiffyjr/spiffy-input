<?php
 
namespace Spiffy\Input\Validator;

final class BooleanValidator extends AbstractValidator
{
    /** @var string */
    protected $errorMessage = 'Must be a boolean';
    
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return filter_var($input, FILTER_VALIDATE_BOOLEAN);
    }
}
