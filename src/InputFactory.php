<?php
 
namespace Spiffy\Input;

final class InputFactory
{
    /**
     * @param mixed $spec
     * @throws Exception\InvalidInputException
     * @return Input
     */
    public function create($spec)
    {
        if (is_array($spec)) {
            return $this->createFromArray($spec);
        }
        
        if ($spec instanceof Input) {
            return $spec;
        }
        
        throw new Exception\InvalidInputException(
            'Filter must be an array or instance of Spiffy\Input\Input'
        );
    }

    /**
     * @param array $spec
     * @return BasicInput
     */
    public function createFromArray(array $spec)
    {
        $input = new BasicInput();
        
        $filters = isset($spec['filters']) ? $spec['filters'] : [];
        $filters = is_array($filters) ? $filters : [$filters]; 
        
        $validators = isset($spec['validators']) ? $spec['validators'] : [];
        $validators = is_array($validators) ? $validators : [$validators];
        
        foreach ($filters as $name => $options) {
            if (!is_string($name)) {
                $name = $options;
                $options = [];
            }

            $input->filters()->add(['name' => $name, 'options' => $options]);
        }
        
        foreach ($validators as $name => $options) {
            if (!is_string($name)) {
                $name = $options;
                $options = [];
            }
            
            $input->validators()->add(['name' => $name, 'options' => $options]);
        }
        
        return $input;
    }
}
