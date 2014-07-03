<?php
 
namespace Spiffy\Validate;

class EmailValidator implements Validator
{
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return false !== filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}