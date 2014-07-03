<?php
 
namespace Spiffy\Input\Validator\TestAsset;

use Spiffy\Input\Validator\Validator;

class TestValidator implements Validator
{
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        return $input === true;
    }
}