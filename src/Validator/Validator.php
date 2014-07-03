<?php
 
namespace Spiffy\Input\Validator;

interface Validator
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function valid($input);
}