<?php
 
namespace Spiffy\Input\Filter;

interface Filter
{
    /**
     * @param mixed $input
     * @return mixed
     */
    public function filter($input);
}
