<?php
 
namespace Spiffy\Input\Validator;

interface ErrorMessageAware
{
    /**
     * @return string
     */
    public function getErrorMessage();

    /**
     * @param string $message
     * @return void
     */
    public function setErrorMessage($message);
}