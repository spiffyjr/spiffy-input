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
    /** @var \SplPriorityQueue */
    private $validators;

    /**
     * @param \Closure|Validator $validator
     * @param int $priority
     * @throws Exception\InvalidValidatorException
     * @return $this
     */
    public function add($validator, $priority = 0)
    {
        if (!$validator instanceof \Closure && !$validator instanceof Validator) {
            throw new Exception\InvalidValidatorException(
                'Validator must be a Closure or Spiffy\Input\Validator\Validator'
            );
        }
        $this->insert($validator, $priority);
        return $this;
    }

    /**
     * Cloned to prevent altering of the internal queue.
     * 
     * @return \SplPriorityQueue
     */
    public function getValidators()
    {
        return clone $this->validators;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function valid($input)
    {
        foreach ($this->getValidators() as $v) {
            if ($v instanceof Validator) {
                if (!$v->valid($input)) {
                    return false;
                }
            } elseif ($v instanceof \Closure) {
                if (!$v($input)) {
                    return false;
                }
            }
        }
        return true;
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
}
