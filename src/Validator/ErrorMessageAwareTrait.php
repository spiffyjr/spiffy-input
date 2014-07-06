<?php
 
namespace Spiffy\Input\Validator;

trait ErrorMessageAwareTrait
{
    /** @var string */
    protected $errorMessage;

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
