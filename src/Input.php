<?php

namespace Spiffy\Input;

interface Input
{
    /**
     * @return mixed
     */
    public function getRawValue();

    /**
     * @param mixed $value
     * @return mixed
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @return bool
     */
    public function isValid();
    
    /**
     * @return \Spiffy\Input\Filter\FilterChain
     */
    public function filters();

    /**
     * @return \Spiffy\Input\Validator\ValidatorChain
     */
    public function validators();
}
