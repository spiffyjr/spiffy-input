<?php

namespace Spiffy\Input\Validator;

use Spiffy\Input\OptionsAware;

final class ValidatorFactory
{
    /**
     * @param mixed $spec
     * @throws Exception\InvalidValidatorException
     * @return Validator
     */
    public function create($spec)
    {
        if ($spec instanceof \Closure || $spec instanceof Validator) {
            return $spec;
        }

        if (is_string($spec)) {
            return $this->createFromArray([$spec]);
        }

        if (is_array($spec)) {
            return $this->createFromArray($spec);
        }

        throw new Exception\InvalidValidatorException(
            'Validator must be a astring, an array, Closure or instance of Spiffy\Input\Validator\Validator'
        );
    }

    /**
     * @param array $spec
     * @return Validator
     * @throws Exception\MissingNameException
     * @throws Exception\InvalidValidatorException
     */
    public function createFromArray(array $spec)
    {
        if (!isset($spec['name'])) {
            throw new Exception\MissingNameException('Validators created from an array must specify a name');
        }

        $validatorClass = $spec['name'];
        if (!class_exists($validatorClass)) {
            $validatorClass = sprintf('Spiffy\\Input\\Validator\\%sValidator', $spec['name']);
        }

        if (!class_exists($validatorClass)) {
            throw new Exception\InvalidValidatorException(sprintf(
                'Validator class "%s" could not be found',
                $validatorClass
            ));
        }

        $validator = new $validatorClass();
        
        if ($validator instanceof ErrorMessageAware && isset($spec['error_message'])) {
            $validator->setErrorMessage($spec['error_message']);
        }

        if ($validator instanceof OptionsAware) {
            $validator->setOptions(isset($spec['options']) ? $spec['options'] : []);
        }

        return $validator;
    }
}
