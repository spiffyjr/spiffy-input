<?php
 
namespace Spiffy\Input\Validator;

final class EmailValidator implements Validator
{
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return false !== filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}