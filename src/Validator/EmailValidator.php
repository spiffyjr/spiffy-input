<?php
 
namespace Spiffy\Input\Validator;

final class EmailValidator extends AbstractValidator
{
    /** @var string */
    protected $errorMessage = 'Must be a valid email address';
    
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return false !== filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}
