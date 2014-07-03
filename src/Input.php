<?php

namespace Spiffy\Input;

interface Input
{
    /**
     * @return string
     */
    public function getName();

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
     * @return bool
     */
    public function valid();
    
    /**
     * @return \Spiffy\Input\Filter\FilterChain
     */
    public function filters();

    /**
     * @return \Spiffy\Input\Validator\ValidatorChain
     */
    public function validators();
}
