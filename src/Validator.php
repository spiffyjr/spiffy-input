<?php
 
namespace Spiffy\Validate;

interface Validator
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function valid($input);
}