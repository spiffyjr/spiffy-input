<?php
 
namespace Spiffy\Input;

interface OptionsAware
{
    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options);

    /**
     * @return array
     */
    public function getOptions();
}