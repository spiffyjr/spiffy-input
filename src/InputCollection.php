<?php
 
namespace Spiffy\Input;

use Spiffy\Input\Validator\ErrorMessageAware;

final class InputCollection
{
    /** @var array */
    private $errors = [];
    /** @var InputFactory */
    private $factory;
    /** @var Input[] */
    private $inputs = [];
    /** @var array */
    private $rawValues = [];
    /** @var array */
    private $values = [];

    /**
     * @param array $spec
     */
    public function __construct(array $spec = [])
    {
        foreach ($spec as $name => $input) {
            $this->add($name, $input);
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $name
     * @param mixed $input
     * @return $this
     */
    public function add($name, $input)
    {
        $this->inputs[$name] = $this->factory()->create($input);
        return $this;
    }

    /**
     * Cloned to prevent altering of the internal queue.
     *
     * @return \SplPriorityQueue|null
     */
    public function inputs()
    {
        return $this->inputs;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $valid = true;

        foreach ($this->inputs as $name => $input) {
            $input->setValue(isset($this->rawValues[$name]) ? $this->rawValues[$name] : null);
            
            if (!$input->isValid()) {
                $valid = false;
                $errors = $input->getErrors();
                
                if (!empty($errors)) {
                    $this->errors[$name] = $input->getErrors();
                }
            }
            
            $this->values[$name] = $input->getValue();
        }
        
        return $valid;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->rawValues = $values;
        $this->values = [];
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }
    
    /**
     * @return InputFactory
     */
    private function factory()
    {
        if (!$this->factory instanceof InputFactory) {
            $this->factory = new InputFactory();
        }
        return $this->factory;
    }
}