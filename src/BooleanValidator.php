<?php
 
namespace Spiffy\Validate;

final class BooleanValidator implements Validator
{
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return filter_var($input, FILTER_VALIDATE_BOOLEAN);
    }
}