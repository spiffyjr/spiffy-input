<?php
 
namespace Spiffy\Input\Validator;

use Spiffy\Input\OptionsAware;
use Spiffy\Input\OptionsAwareTrait;

abstract class AbstractValidator implements ErrorMessageAware, OptionsAware, Validator
{
    use ErrorMessageAwareTrait;
    use OptionsAwareTrait;
}