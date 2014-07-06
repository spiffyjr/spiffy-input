<?php
 
namespace Spiffy\Input\Validator;

final class NotEmptyValidator extends AbstractValidator
{
    /** @var string */
    protected $errorMessage = 'Must not be empty';
    
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return !empty($input);
    }
}
