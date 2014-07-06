<?php
 
namespace Spiffy\Input\Validator;

final class ValidatorChain implements Validator
{
    /**
     * This is used to give some regularity (FIFO) to SplPriorityQueue when queueing
     * with the same priority.
     *
     * @var int
     */
    protected $queueOrder = PHP_INT_MAX;
    /** @var array */
    private $errors = [];
    /** @var ValidatorFactory */
    private $factory;
    /** @var \SplPriorityQueue */
    private $validators;

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $validator
     * @param int $priority
     * @return $this
     */
    public function add($validator, $priority = 0)
    {
        $this->insert($this->factory()->create($validator), $priority);
        return $this;
    }

    /**
     * Cloned to prevent altering of the internal queue.
     * 
     * @return \SplPriorityQueue|null
     */
    public function validators()
    {
        return $this->validators ? clone $this->validators : null;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function valid($input)
    {
        $validators = $this->validators();
        
        if (null === $validators) {
            return true;
        }
        
        $result = true;
        foreach ($validators as $v) {
            if ($v instanceof Validator) {
                if (!$v->valid($input)) {
                    if ($v instanceof ErrorMessageAware) {
                        $this->errors[] = $v->getErrorMessage();
                    }
                    $result = false;
                }
            } elseif ($v instanceof \Closure) {
                if (!$v($input)) {
                    $result = false;
                }
            }
        }
        return $result;
    }

    /**
     * @param \Closure|Validator $object
     * @param int $priority
     */
    private function insert($object, $priority)
    {
        if (!$this->validators instanceof \SplPriorityQueue) {
            $this->validators = new \SplPriorityQueue();
        }
        $this->validators->insert($object, [$priority, $this->queueOrder--]);
    }

    /**
     * @return ValidatorFactory
     */
    private function factory()
    {
        if (!$this->factory instanceof ValidatorFactory) {
            $this->factory = new ValidatorFactory();
        }
        return $this->factory;
    }
}
