<?php
 
namespace Spiffy\Input\Validator;

use Spiffy\Input\OptionsAwareTrait;

final class StringLengthValidator extends AbstractValidator
{
    /**
     * {@inheritDoc}
     */
    public function valid($input)
    {
        $min = $this->getOption('min');
        $max = $this->getOption('max');
        $length = strlen($input);
        
        if ($min && $max) {
            $this->errorMessage = sprintf('Must be between %s and %s characters', $min, $max);
        } elseif ($min) {
            $this->errorMessage = sprintf('Must be greater than %s characters', $min);
        } else {
            $this->errorMessage = sprintf('Must be less than %s characters', $min);
        }
        
        if (null !== $min && $length < $min) {
            return false;
        }
        
        if (null !== $max && $length > $max) {
            return false;
        }
        
        return true;
    }
}
