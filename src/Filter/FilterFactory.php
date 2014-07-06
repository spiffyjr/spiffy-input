<?php
 
namespace Spiffy\Input\Filter;

use Spiffy\Input\OptionsAware;

final class FilterFactory
{
    /**
     * @param mixed $spec
     * @throws Exception\InvalidFilterException
     * @return Filter
     */
    public function create($spec)
    {
        if ($spec instanceof \Closure || $spec instanceof Filter) {
            return $spec;
        }
        
        if (is_string($spec)) {
            return $this->createFromArray([$spec]);
        }
        
        if (is_array($spec)) {
            return $this->createFromArray($spec);
        }
        
        throw new Exception\InvalidFilterException(
            'Filter must be a astring, an array, Closure or instance of Spiffy\Input\Filter\Filter'
        );
    }
    
    public function createFromArray(array $spec)
    {
        if (!isset($spec['name'])) {
            throw new Exception\MissingNameException('Filters created from an array must specify a name');
        }
        
        $filterClass = $spec['name'];
        if (!class_exists($filterClass)) {
            $filterClass = sprintf('Spiffy\\Input\\Filter\\%sFilter', $spec['name']);
        }
        
        if (!class_exists($filterClass)) {
            throw new Exception\InvalidFilterException(sprintf(
                'Filter class "%s" could not be found',
                $filterClass
            ));
        }
        
        $filter = new $filterClass();
        
        if ($filter instanceof OptionsAware) {
            $filter->setOptions(isset($spec['options']) ? $spec['options'] : []);
        }
        
        return $filter;
    }
}
