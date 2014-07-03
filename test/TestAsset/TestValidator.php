<?php
 
namespace Spiffy\Validate\TestAsset;

use Spiffy\Validate\Validator;

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