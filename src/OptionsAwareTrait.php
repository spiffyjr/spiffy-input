<?php
 
namespace Spiffy\Input;

trait OptionsAwareTrait
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    final public function getOption($key, $default = null)
    {
        return isset($this->options[$key]) ? $this->options[$key] : $default;
    }

    /**
     * @param array $options
     */
    final public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    final public function getOptions()
    {
        return $this->options;
    }
}