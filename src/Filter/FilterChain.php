<?php
 
namespace Spiffy\Input\Filter;

final class FilterChain implements Filter
{
    /**
     * This is used to give some regularity (FIFO) to SplPriorityQueue when queueing
     * with the same priority.
     *
     * @var int
     */
    protected $queueOrder = PHP_INT_MAX;
    /** @var FilterFactory */
    private $factory;
    /** @var \SplPriorityQueue */
    private $filters;

    /**
     * @param \Closure|Filter $filter
     * @param int $priority
     * @throws Exception\InvalidFilterException
     * @return $this
     */
    public function add($filter, $priority = 0)
    {
        $this->insert($this->factory()->create($filter), $priority);
        return $this;
    }

    /**
     * Cloned to prevent altering of the internal queue.
     * 
     * @return \SplPriorityQueue|null
     */
    public function filters()
    {
        return $this->filters ? clone $this->filters : null;
    }

    /**
     * @param mixed $input
     * @return mixed
     */
    public function filter($input)
    {
        $filters = $this->filters();
        
        if (null === $filters) {
            return $input;
        }
        
        foreach ($filters as $f) {
            if ($f instanceof Filter) {
                $input = $f->filter($input);
            } elseif ($f instanceof \Closure) {
                $input = $f($input);
            }
        }
        return $input;
    }

    /**
     * @param \Closure|Filter $object
     * @param int $priority
     */
    private function insert($object, $priority)
    {
        if (!$this->filters instanceof \SplPriorityQueue) {
            $this->filters = new \SplPriorityQueue();
        }
        $this->filters->insert($object, [$priority, $this->queueOrder--]);
    }

    /**
     * @return FilterFactory
     */
    private function factory()
    {
        if (!$this->factory instanceof FilterFactory) {
            $this->factory = new FilterFactory();
        }
        return $this->factory;
    }
}
