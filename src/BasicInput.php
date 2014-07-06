<?php
 
namespace Spiffy\Input;

use Spiffy\Input\Filter\FilterChain;
use Spiffy\Input\Validator\ValidatorChain;

final class BasicInput implements Input
{
    /** @var  \Spiffy\Input\Filter\FilterChain */
    private $filters;
    /** @var  \Spiffy\Input\Validator\ValidatorChain */
    private $validators;
    /** @var mixed */
    private $value;
    /** @var  mixed */
    private $rawValue;

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->validators()->getErrors();
    }

    /**
     * @return mixed
     */
    public function getRawValue()
    {
        return $this->rawValue;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function setValue($value)
    {
        $this->rawValue = $value;
        $this->value = null;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $value = $this->value = $this->filters()->filter($this->rawValue);
        return $this->validators()->valid($value);
    }

    /**
     * @return \Spiffy\Input\Filter\FilterChain
     */
    public function filters()
    {
        if (!$this->filters instanceof FilterChain) {
            $this->filters = new FilterChain();
        }
        return $this->filters;
    }

    /**
     * @return \Spiffy\Input\Validator\ValidatorChain
     */
    public function validators()
    {
        if (!$this->validators instanceof ValidatorChain) {
            $this->validators = new ValidatorChain();
        }
        return $this->validators;
    }
}
